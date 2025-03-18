@extends('layouts.app')

@section('content')
    <!-- breadcrumb -->
    <nav area-label="breadcrumb">

        <ol class="breadcrumb">
            <a href="{{ route('home') }}" class="text-decoration-none mr-3">
                <li class="breadcrumb-item">Trang chủ</li>
            </a>
            <li class="breadcrumb-item active">Slides</li>
        </ol>

    </nav>

    <!-- Dispaly all slides from DB -->
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <span>Slides</span>
            <a href="{{ route('slides.create') }}" class="btn btn-dark">Thêm Slide</a>
        </div>
        <div class="card-body">
            <table class="table table-dark table-bordered">
                <thead>
                    <th>Hình ảnh</th>
                    <th>Hành động</th>
                 </thead>
                <tbody>
                    @foreach ($slides as $slide)
                        <tr>
                            <td>
                                <img src="/storage/{{ $slide->image }}"
                                    style="border-radius: 100%; width: 100px; height: 100px;">
                            </td>
                            <td>
                                <a href="{{ route('slides.edit', $slide->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                                <form action="{{ route('slides.destroy', $slide->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
