@extends('layouts.app')

@section('content')
<div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 20px; width: 950px; height: 500px; display: flex; flex-direction: row; background: white;">
    
    <div class="p-5" style="width: 55%;">
        <h3 class="fw-bold mb-1 text-dark" style="font-size: 1.4rem;">Log In</h3>
        <p class="text-muted mb-4" style="font-size: 0.75rem;">Welcome back! Please enter your details to continue.</p>

        @if(session('success'))
            <div class="alert alert-success py-1 px-3 mb-3 border-0 shadow-sm" style="font-size: 0.7rem; background-color: #d1fae5; color: #065f46;">
                <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold text-dark mb-1" style="font-size: 0.7rem;">Email Address</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                    <input type="email" name="email" class="form-control bg-light border-start-0" placeholder="name@example.com" required style="font-size: 0.75rem;">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold text-dark mb-1" style="font-size: 0.7rem;">Password</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                    <input type="password" name="password" class="form-control bg-light border-start-0" placeholder="••••••••" required style="font-size: 0.75rem;">
                </div>
            </div>

            <button type="submit" class="btn w-100 fw-bold py-2 shadow-sm mb-3" style="background: #3182ce; color: white; border-radius: 10px; font-size: 0.85rem;">
                Log In
            </button>

            <p class="text-center text-muted" style="font-size: 0.7rem;">
                Don't have an account? <a href="/register" class="text-primary fw-bold text-decoration-none">Sign Up</a>
            </p>
        </form>
    </div>

    <div class="d-flex flex-column align-items-center justify-content-center text-center" style="width: 45%; background: #f8fafc; padding: 40px;">
        <img src="{{ asset('images/side.jpeg') }}" alt="Illustration" style="width: 100%; max-width: 250px; height: auto; object-fit: contain;">
        <div class="mt-4 px-3">
            <h6 class="fw-bold text-dark" style="font-size: 0.85rem;">Secure Access</h6>
            <p class="text-muted" style="font-size: 0.65rem; line-height: 1.5;">Your security is our priority. Log in to manage your reports and find lost items.</p>
        </div>
    </div>

</div>
@endsection