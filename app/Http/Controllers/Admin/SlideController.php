<?php

namespace App\Http\Controllers\Admin;

 use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{

    public function index()
    {
        $slides = Slide::all();

        return view('admin.slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.slides.create');
    }

    public function store(Request $request)
    {
        $image = $request->image->store('uploads/slides', 'public');

        Slide::create([
            'image' => $image,
            'heading' => $request->heading,
            'description' => $request->description,
            'link' => $request->link,
            'from_price' => $request->from_price,
        ]);

        session()->flash('success', 'Slider added successfully');

        return redirect(route('slides.index'));
    }
    public function edit($id)
    {
        $slide = Slide::findOrFail($id);

        return view('admin.slides.create', compact('slide'));
    }

    public function update(Request $request, $id)
    {
        $slide = Slide::findOrFail($id);

        if ($request->hasFile('image')) {
           Storage::disk('public')->delete($slide->image);

           $image = $request->image->store('uploads/slides', 'public');

        }

        $slide->update([
            'image' => $image ?? $slide->image,
            'description' => $request->description,
            'link' => $request->link,
            'from_price' => $request->from_price,
        ]);

        session()->flash('success', 'Slider updated successfully');

        return redirect(route('slides.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slide::findOrFail($id);

        Storage::disk('public')->delete($slide->image);

        $slide->delete();

        session()->flash('success', 'Slider deleted successfully');

        return redirect(route('slides.index'));
    }
}