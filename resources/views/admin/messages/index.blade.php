@extends('layouts.app')

@section('content')
    <!-- breadcrumb -->
    <nav area-label="breadcrumb">

        <ol class="breadcrumb">
            <a href="{{ route('home') }}" class="text-decoration-none mr-3">
                <li class="breadcrumb-item">Trang chủ</li>
            </a>
            <li class="breadcrumb-item active">Góp ý</li>
        </ol>

    </nav>

    <!-- Dispaly all products from DB -->
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <span>Góp ý</span>
        </div>
        <div class="card-body">
            <table class="table table-dark table-bordered table-responsive">
                <thead>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Tiêu đề</th>
                    <th>Thời gian</th>
                    <th>Read</th>
                </thead>
                <tbody>
                    @foreach ($messages as $index => $message)
                        <tr>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->subject }}</td>
                            <td>{{ $message->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('contact.show', $message->id) }}">
                                    <button class="btn btn-success btn-sm">Read Message</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
