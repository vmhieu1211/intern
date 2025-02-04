@extends('layouts.app')

@section('content')

<nav area-label="breadcrumb">

	<ol class="breadcrumb">
		<a href="{{ route('home') }}" class="text-dectoration-none mr-3">
			<li class="breadcrumb-item">Trang chủ</li>
		</a>
		<li class="breadcrumb-item active">Danh mục</li>
	</ol>
	
</nav>

<div class="card">
	<div class="card-header d-flex justify-content-between">
		<span>Danh mục</span>
		<a href="{{ route('categories.create') }}" class="btn btn-dark">Thêm Danh mục</a>
	</div>
	<div class="card-body">
		<table class="table table-bordered table-dark">
			<thead>
				<th>#</th>
				<th>Tên Danh mục</th>
				<th>Slug</th>
				<th>Chỉnh sửa</th>
				<th>Xóa</th>
			</thead>
			<tbody>
				@foreach($categories as $index => $cat)
				<tr>
					<td>{{ $index+1 }}</td>
					<td>{{ $cat->name }}</td>
					<td>{{ $cat->slug }}</td>
					<td><a href="{{ route('categories.edit', $cat->slug) }}" class="btn btn-primary btn-sm">Chỉnh sửa</a></td>
					<td>
						<form action="{{ route('categories.destroy', $cat->slug) }}" method="post">
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