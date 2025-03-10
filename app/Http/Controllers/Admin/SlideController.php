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
        ]);

        return redirect()->route('slides.index')->with('success', 'Slider added successfully');
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
        ]);

        return redirect()->route('slides.index')->with('success', 'Slider updated successfully');
    }

    public function destroy($id)
    {
        $slide = Slide::findOrFail($id);

        Storage::disk('public')->delete($slide->image);

        $slide->delete();

        return redirect()->route('slides.index')->with('success', 'Slider deleted successfully');
    }
}
