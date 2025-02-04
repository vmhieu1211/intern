@extends('layouts.app')

@section('content')

<!-- breadcrumb -->
<nav area-label="breadcrumb">

	<ol class="breadcrumb">
		<a href="{{ route('home') }}" class="text-decoration-none mr-3">
			<li class="breadcrumb-item">Home</li>
		</a>
		<li class="breadcrumb-item active">Cài đặt hệ thống</li>
	</ol>
	
</nav>

<div class="card">
	<div class="card-header">Cài đặt hệ thống</div>
	<div class="card-body">
		<table class="table table-dark table-bordered">
			<thead>
				<th>Tên</th>
				<th>Logo</th>
				<th>Favicon</th>
				<th>Số điện thoại</th>
				<th>Email</th>
				<th>Chỉnh sửa</th>
			</thead>
			<tbody>
				<tr>
					<td> {{ $setting->name }} </td>
					<td> 
						<img src="/storage/{{ $setting->logo }}" style="width: 81px; height: 22px;">
					</td>
					<td> 
						<img src="/storage/{{ $setting->favicon }}" style="width: 40px; height: 40px; border-radius: 100%;">
					</td>
					<td> {{ $setting->tel }} </td>
					<td> {{ $setting->email }} </td>
					<td>
						<a href="{{ route('system-settings.edit', $setting->slug) }}" class="btn btn-primary">Chỉnh sửa</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

@endsection