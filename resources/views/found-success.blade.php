@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <div class="card shadow-sm p-5 border-0" style="border-radius: 20px;">
        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
        <h2 class="fw-bold mt-3">Thank You!</h2>
        <p class="text-muted">Your report for <strong>{{ $item_name }}</strong> has been submitted. You're a hero!</p>
        <div class="mt-4">
            <a href="{{ route('home') }}" class="btn btn-primary px-4">Back to Home</a>
            <a href="{{ route('items.matches') }}" class="btn btn-outline-primary px-4">Check My Matches</a>
        </div>
    </div>
</div>
@endsection