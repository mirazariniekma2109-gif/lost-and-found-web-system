@extends('layouts.app')

@section('content')
<div class="container text-center" style="max-width: 900px;">
    <h1 class="fw-bold mb-1">Lost Something? Found Something?</h1>
    <p class="text-muted mb-4">Easily report lost and found items and reconnect with rightful owners.</p>

    <div class="row g-4 justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 bg-transparent">
                <img src="{{ asset('images/leftside.jpeg') }}" class="mx-auto mb-3" style="width: 250px; height: 180px; object-fit: contain;">
                <a href="{{ route('lost.create') }}" class="btn fw-bold py-2 shadow-sm" style="background: #f6ad55; color: white; border-radius: 10px;">
                    <i class="bi bi-exclamation-triangle me-2"></i> Report Lost Item
                </a>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card border-0 bg-transparent">
                <img src="{{ asset('images/rightside.jpeg') }}" class="mx-auto mb-3" style="width: 250px; height: 180px; object-fit: contain;">
                <a href="{{ route('found.create') }}" class="btn fw-bold py-2 shadow-sm" style="background: #f6ad55; color: white; border-radius: 10px;">
                    <i class="bi bi-search me-2"></i> Report Found Item
                </a>
            </div>
        </div>
    </div>
</div>
@endsection