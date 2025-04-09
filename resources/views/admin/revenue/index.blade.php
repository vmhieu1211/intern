@extends('layouts.app')

@section('content')
    <nav area-label="breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('home') }}" class="text-dectoration-none mr-3">
                <li class="breadcrumb-item">Home</li>
            </a>
            <li class="breadcrumb-item active">Revenue</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">Revenue</div>
        <div class="container">
            <h1>Revenue Report</h1>
            <div class="card mb-3">
                <div class="card-body">
                    <h4>Daily Revenue</h4>
                    <p>{{ number_format($dailyRevenue) }}đ</p>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h4>Monthly Revenue</h4>
                    <p>{{ number_format($monthlyRevenue) }} đ</p>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h4>Yearly Revenue</h4>
                    <p>{{ number_format($yearlyRevenue) }} đ</p>
                </div>
            </div>
        </div>
    </div>
@endsection
