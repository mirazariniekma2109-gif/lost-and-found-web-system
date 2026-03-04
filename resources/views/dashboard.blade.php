@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-3" style="max-width: 1200px;">
    
    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Header --}}
    <div class="row mb-3">
        <div class="col-12 text-start">
            <h2 class="fw-bold text-dark mb-0" style="font-size: 1.5rem;">User Dashboard</h2>
            <p class="text-muted small">Manage your reports and track matches efficiently.</p>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm" style="border-radius: 15px; background: linear-gradient(45deg, #243b53, #334e68); color: white;">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                        <i class="bi bi-search" style="font-size: 1.5rem;"></i>
                    </div>
                    <div>
                        <p class="mb-0 small opacity-75">Items You've Lost</p>
                        <h3 class="fw-bold mb-0">{{ $myLostItems->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm" style="border-radius: 15px; background: linear-gradient(45deg, #48bb78, #38a169); color: white;">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                        <i class="bi bi-box-seam" style="font-size: 1.5rem;"></i>
                    </div>
                    <div>
                        <p class="mb-0 small opacity-75">Items You've Found</p>
                        <h3 class="fw-bold mb-0">{{ $myFoundItems->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 1. My Lost Item Reports --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
        <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-dark" style="font-size: 1rem;">My Lost Item Reports</h5>
            <a href="{{ route('lost.create') }}" class="btn btn-warning btn-sm fw-bold px-3">+ New Report</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small text-uppercase">
                        <tr>
                            <th class="ps-4">Item Name</th>
                            <th>Category</th>
                            <th>Date Reported</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 0.85rem;">
                        @forelse($myLostItems as $item)
                        <tr>
                            <td class="ps-4 fw-semibold text-dark">{{ $item->item_name }}</td>
                            <td class="text-muted">{{ $item->category }}</td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('matches.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">Check Matches</a>
                                    
                                    {{-- FORM DELETE LOST ITEM --}}
                                    <form action="{{ route('lost.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this report?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-4 text-muted">No lost reports found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- 2. My Found Item Reports --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
        <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-dark" style="font-size: 1rem;">My Found Item Reports</h5>
            <a href="{{ route('found.create') }}" class="btn btn-success btn-sm fw-bold px-3">+ New Report</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small text-uppercase">
                        <tr>
                            <th class="ps-4">Item Name</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 0.85rem;">
                        @forelse($myFoundItems as $found)
                        <tr>
                            <td class="ps-4 fw-semibold text-dark">{{ $found->item_name }}</td>
                            <td class="text-muted">{{ $found->category }}</td>
                            <td><span class="badge bg-success opacity-75">{{ ucfirst($found->status) }}</span></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('found.edit', $found->id) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Edit</a>
                                    
                                    {{-- FORM DELETE FOUND ITEM --}}
                                    <form action="{{ route('found.destroy', $found->id) }}" method="POST" onsubmit="return confirm('Delete this found item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-4 text-muted">No found reports found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- 3. UNCLAIMED ITEMS --}}
    <div class="row mt-5 mb-3">
        <div class="col-12 text-start">
            <h2 class="fw-bold text-dark mb-0" style="font-size: 1.5rem;">Unclaimed Items</h2>
            <p class="text-muted small">Items reported by others that have not been claimed yet.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-5" style="border-radius: 15px;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-primary text-white small text-uppercase">
                        <tr>
                            <th class="ps-4">Found Item</th>
                            <th>Location</th>
                            <th>Availability</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 0.85rem;">
                        @forelse($unclaimedItems as $unclaimed)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    @if($unclaimed->image)
                                        <img src="{{ asset('storage/' . $unclaimed->image) }}" class="rounded me-2" style="width: 35px; height: 35px; object-fit: cover;">
                                    @endif
                                    <span class="fw-bold">{{ $unclaimed->item_name }}</span>
                                </div>
                            </td>
                            <td>{{ $unclaimed->location_found }}</td>
                            <td><span class="badge bg-info text-dark">Not Claimed</span></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $unclaimed->finder_contact) }}" target="_blank" class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm">
                                        <i class="bi bi-whatsapp"></i> Claim
                                    </a>
                                    <a href="{{ route('match.report', $unclaimed->id) }}" class="btn btn-sm btn-danger rounded-pill px-3 shadow-sm">
                                        <i class="bi bi-file-pdf"></i> PDF
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-5 text-muted">No unclaimed items found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection