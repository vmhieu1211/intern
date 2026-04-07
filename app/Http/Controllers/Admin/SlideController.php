<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SlideRequest;
use App\Models\Slide;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function index()
    {
        return view('admin.slides.index', ['slides' => Slide::all()]);
    }

    public function create()
    {
        return view('admin.slides.create');
    }

    public function store(SlideRequest $request)
    {
        $image = $request->file('image')->store('uploads/slides', 'public');

        Slide::create(['image' => $image]);

        return redirect()->route('slides.index')->with('success', 'Thêm slide thành công!');
    }

    public function edit($id)
    {
        return view('admin.slides.create', ['slide' => Slide::findOrFail($id)]);
    }

    public function update(SlideRequest $request, $id)
    {
        $slide = Slide::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($slide->image);
            $slide->image = $request->file('image')->store('uploads/slides', 'public');
        }

        $slide->save();

        return redirect()->route('slides.index')->with('success', 'Cập nhật slide thành công!');
    }

    public function destroy($id)
    {
        $slide = Slide::findOrFail($id);
        Storage::disk('public')->delete($slide->image);
        $slide->delete();

        return redirect()->route('slides.index')->with('success', 'Xóa slide thành công!');
    }
}
