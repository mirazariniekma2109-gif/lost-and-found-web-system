@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 20px; width: 950px; height: 580px; display: flex; flex-direction: row; background: white;">
        
        <div class="p-5" style="width: 55%; overflow-y: auto;">
            <h3 class="fw-bold mb-1 text-dark" style="font-size: 1.4rem;">Sign Up</h3>
            <p class="text-muted mb-4" style="font-size: 0.75rem;">Create your account to report and find lost items easily.</p>

            @if ($errors->any())
                <div class="alert alert-danger py-2" style="font-size: 0.7rem;">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf
                
                <div class="mb-2">
                    <label class="form-label fw-semibold text-dark mb-1" style="font-size: 0.7rem;">Full Name</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                        <input type="text" name="name" class="form-control bg-light border-start-0" placeholder="Enter your name" value="{{ old('name') }}" required style="font-size: 0.75rem;">
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label fw-semibold text-dark mb-1" style="font-size: 0.7rem;">Email Address</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                        <input type="email" name="email" class="form-control bg-light border-start-0" placeholder="name@example.com" value="{{ old('email') }}" required style="font-size: 0.75rem;">
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label fw-semibold text-dark mb-1" style="font-size: 0.7rem;">Phone Number</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-telephone text-muted"></i></span>
                        <input type="text" name="phone" class="form-control bg-light border-start-0" placeholder="+60123456789" value="{{ old('phone') }}" required style="font-size: 0.75rem;">
                    </div>
                </div>

                <div class="row g-2">
                    <div class="col-md-6 mb-2">
                        <label class="form-label fw-semibold text-dark mb-1" style="font-size: 0.7rem;">Password</label>
                        <input type="password" name="password" class="form-control form-control-sm bg-light" placeholder="••••••••" required style="font-size: 0.75rem;">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label fw-semibold text-dark mb-1" style="font-size: 0.7rem;">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control form-control-sm bg-light" placeholder="••••••••" required style="font-size: 0.75rem;">
                    </div>
                </div>

                <div class="form-check mb-3 mt-1">
                    <input class="form-check-input" type="checkbox" id="terms" required>
                    <label class="form-check-label text-muted" for="terms" style="font-size: 0.65rem;">
                        I agree to the <a href="#" class="text-primary text-decoration-none">Terms and Conditions</a>
                    </label>
                </div>

                <button type="submit" class="btn w-100 fw-bold py-2 shadow-sm" style="background: #f6ad55; color: white; border-radius: 10px; font-size: 0.85rem;">
                    Sign Up
                </button>

                <p class="text-center mt-3 text-muted" style="font-size: 0.7rem;">
                    Already have an account? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Log In</a>
                </p>
            </form>
        </div>

        <div style="width: 45%; background: #f8fafc; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 40px;">
            <img src="{{ asset('images/side.jpeg') }}" alt="Illustration" style="width: 100%; max-width: 300px; height: auto; object-fit: contain;">
            <div class="mt-4 text-center px-4">
                <h6 class="fw-bold text-dark" style="font-size: 0.85rem;">Secure Your Belongings</h6>
                <p class="text-muted" style="font-size: 0.65rem; line-height: 1.5;">Join thousands of users in our community to help recover lost items faster and safer.</p>
            </div>
        </div>

    </div>
</div>
@endsection