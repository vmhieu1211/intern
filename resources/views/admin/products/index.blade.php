@extends('layouts.app')

@section('content')
<!-- breadcrumb -->
<nav area-label="breadcrumb">

	<ol class="breadcrumb">
		<a href="{{ route('home') }}" class="text-decoration-none mr-3">
			<li class="breadcrumb-item">Home</li>
		</a>
		<li class="breadcrumb-item active">{{ $products->count() }} Products</li>
	</ol>
	
</nav>
<!-- Dispaly all products from DB -->
<div class="card">
	<div class="card-header d-flex justify-content-between">
		<span>{{ $products->count() }} Sản phẩm</span>
		
		{{-- Search here --}}
		<form action="{{ route('products.index') }}" method="GET" class="form-inline">
            <input 
                type="text" 
                name="search" 
                class="form-control mr-2" 
                placeholder="Search products..." 
                value="{{ request('search') }}" 
            />
            <button class="btn btn-primary" type="submit">Search</button>
        </form>

		<a href="{{ route('products.create') }}" class="btn btn-dark">Thêm sản phẩm</a>
	</div>
	<div class="card-body">
		<table class="table table-dark table-bordered table-responsive">
			<thead>
				<th>STT</th>
				<th>Tên sản phẩm</th>
				<th>Danh mục</th>
				<th>Sub-Category</th>
				<th>Ảnh</th>
				<th>Giá</th>
				<th>Số lượng</th>
				<th>Sửa</th>
				<th>Xóa</th>
			</thead>
			<tbody>
				@foreach($products as $index => $p)
				<tr>
					<td>{{ $index + 1 }}</td>
					<td>{{ $p->name }}</td>
					<td>{{ $p->category->name }}</td>
					<td>
						@if($p->sub_category_id != null)
						       {{ $p->subCategory->name ?? 'No subcategory' }}
						@else
						<p>N/A</p>
						@endif
					</td>
					<td>
						@if($p->photos->count() > 0)
                            <img src="/storage/{{ $p->photos->first()->images }}" style="border-radius: 100%; width: 25px; height: 25px;">
                        @else
                            <img src="{{ asset('frontend/img/no-image.png') }}" style="border-radius: 100%; width: 25px; height: 25px;">
                        @endif
					</td>
					<td>{{ $p->price }}</td>
					<td>{{ $p->quantity }}</td>
					<td>
						<a href="{{ route('products.edit', $p->slug) }}" class="btn btn-primary btn-sm">Sửa</a>
					</td>
					<td>
						<form action="{{ route('products.destroy', $p->slug) }}" method="post">
							@csrf
							@method('DELETE')
							<button class="btn btn-danger btn-sm">Xóa</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		<div class="pagination">
			{{ $products->links() }}
		</div>
	</div>
</div>

@endsection