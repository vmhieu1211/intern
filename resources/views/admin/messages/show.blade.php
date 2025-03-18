@extends('layouts.app')

@section('content')
    <!-- breadcrumb -->
    <nav area-label="breadcrumb">

        <ol class="breadcrumb">
            <a href="{{ route('contactMessages') }}" class="text-decoration-none mr-3">
                <li class="breadcrumb-item">Góp ý</li>
            </a>
            <li class="breadcrumb-item active text-capitalize">{{ $message->subject }} Từ {{ $message->name }} </li>
        </ol>

    </nav>

    <div class="card col-lg col-xl flex-row mx-auto px-0">
        <div class="card-header">
            <h4 class="title text-left mb-1">Tên</h4>
            <h6 class="title text-left"> {{ $message->name }} </h6>
            <h4 class="title text-left mb-1">Email</h4>
            <h6 class="title text-left"> {{ $message->email }} </h6>
            <h4 class="title text-left mb-1">Tiêu đề</h4>
            <h6 class="title text-left"> {{ $message->subject }} </h6>
        </div>
        <div class="p-3 m-3">Nội dung: {{ $message->message }} </div>
    </div>
@endsection
