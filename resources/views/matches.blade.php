@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Potential Matches</h2>
            <p class="text-muted">We found these items that might belong to you based on your lost reports.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm px-3 shadow-sm" style="border-radius: 8px;">
            <i class="bi bi-arrow-left me-1"></i> Back to Dashboard
        </a>
    </div>

    @if($matches->isEmpty())
        <div class="card border-0 shadow-sm text-center p-5" style="border-radius: 15px;">
            <div class="card-body">
                <i class="bi bi-search text-muted opacity-50" style="font-size: 4rem;"></i>
                <h5 class="mt-3 fw-bold text-muted">No matches found yet.</h5>
                <p class="text-muted small">Don't worry, we'll notify you once someone finds something similar!</p>
            </div>
        </div>
    @else
        <div class="row g-4">
            @foreach($matches as $match)
                <div class="col-md-4">
                    <div class="card border-0 shadow-lg h-100 overflow-hidden" style="border-radius: 15px; transition: transform 0.3s;">
                        
                        <div class="position-absolute top-0 start-0 m-3">
                            <span class="badge bg-primary shadow-sm px-3 py-2" style="border-radius: 50px; font-size: 0.7rem;">
                                {{ $match->category }}
                            </span>
                        </div>

                        <div style="height: 200px; background: #f8fafc; display: flex; align-items: center; justify-content: center;">
                            @if($match->image)
                                <img src="{{ asset('storage/' . $match->image) }}" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="{{ $match->item_name }}">
                            @else
                                <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                            @endif
                        </div>

                        <div class="card-body p-4">
                            <h5 class="fw-bold text-dark mb-1">{{ $match->item_name }}</h5>
                            <p class="text-muted mb-3" style="font-size: 0.85rem;">
                                <i class="bi bi-geo-alt-fill text-danger me-1"></i> Found at: {{ $match->location_found }}
                            </p>
                            
                            <hr class="my-3 opacity-25">
                            
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-light p-2 rounded-circle me-3">
                                    <i class="bi bi-person-fill text-primary"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold text-dark" style="font-size: 0.8rem;">Found by: {{ $match->user->name ?? 'marlisa' }}</p>
                                    <p class="mb-0 text-muted" style="font-size: 0.75rem;">Contact: {{ $match->finder_contact ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="d-grid mt-2">
                                @if($match->status === 'claimed')
                                    {{-- Keadaan 1: Barang sudah dituntut --}}
                                    <button class="btn btn-secondary fw-bold py-2 shadow-sm text-white-50" style="border-radius: 10px; font-size: 0.85rem;" disabled>
                                        <i class="bi bi-check-circle-fill me-1"></i> Already Claimed
                                    </button>

                                @elseif($match->finder_contact && $match->finder_contact !== '-')
                                    {{-- Keadaan 2: Barang sedia untuk dituntut (Hantar ke Controller) --}}
                                    <form action="{{ route('claim.item', $match->id) }}" method="POST" target="_blank" onsubmit="setTimeout(function(){ location.reload(); }, 1000);">
                                        @csrf
                                        <button type="submit" class="btn btn-primary fw-bold py-2 shadow-sm w-100" 
                                                style="border-radius: 10px; font-size: 0.85rem; background-color: #0d6efd; border: none;">
                                            This is Mine! (Claim)
                                        </button>
                                    </form>
                                @else
                                    {{-- Keadaan 3: Maklumat hubungan tiada --}}
                                    <button class="btn btn-secondary opacity-50 fw-bold py-2 shadow-sm" 
                                            style="border-radius: 10px; font-size: 0.85rem; cursor: not-allowed;" disabled>
                                        Contact Not Available
                                    </button>
                                @endif
                            </div>
                        </div>

                        <div class="card-footer bg-white border-0 pb-3 ps-4">
                            <small class="text-muted">
                                <i class="bi bi-calendar-event me-1"></i> 
                                {{ \Carbon\Carbon::parse($match->date_found)->format('d M Y') }}
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
    }
    .badge {
        letter-spacing: 0.5px;
    }
    .btn-primary:hover {
        background-color: #0b5ed7 !important;
        transform: scale(1.02);
    }
    form {
        margin: 0;
    }
</style>
@endsection