@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh; padding: 20px;">
    <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 15px; width: 850px; height: 550px; display: flex; flex-direction: row; background: white;">
        
        <div class="p-4 custom-scrollbar" style="width: 55%; overflow-y: auto; border-right: 1px solid #f1f5f9;">
            <div class="mb-3">
                <h4 class="fw-bold mb-1 text-dark" style="font-size: 1.2rem;">Report Lost Item</h4>
                <p class="text-muted" style="font-size: 0.7rem;">Provide details of the item you have lost.</p>
            </div>

            <form action="{{ route('lost.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label fw-bold text-dark mb-1" style="font-size: 0.7rem;">Item Name</label>
                    <input type="text" name="item_name" class="form-control form-control-sm bg-light border-0" placeholder="Enter item name..." required style="font-size: 0.75rem; border-radius: 6px;">
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark mb-1" style="font-size: 0.7rem;">Category</label>
                        <select name="category" class="form-select form-select-sm bg-light border-0" required style="font-size: 0.75rem; border-radius: 6px;">
                            <option value="Electronic Devices">Electronic Devices</option>
                            <option value="Wallet/Bag">Wallet/Bag</option>
                            <option value="Documents">Documents</option>
                            <option value="Personal Items">Personal Items</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-dark mb-1" style="font-size: 0.7rem;">Date Lost</label>
                        <input type="date" name="date_lost" class="form-control form-control-sm bg-light border-0" required style="font-size: 0.75rem; border-radius: 6px;">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-dark mb-1" style="font-size: 0.7rem;">Last Seen Location</label>
                    <input type="text" name="location_lost" class="form-control form-control-sm bg-light border-0" placeholder="Where did you last see it?" required style="font-size: 0.75rem; border-radius: 6px;">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-dark mb-1" style="font-size: 0.7rem;">Description</label>
                    <textarea name="description" class="form-control bg-light border-0" rows="3" placeholder="Brief description of the lost item..." style="font-size: 0.75rem; border-radius: 6px;"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-dark mb-1" style="font-size: 0.7rem;">Upload Image</label>
                    <div class="p-2 text-center" style="border: 1.5px dashed #e2e8f0; border-radius: 8px; background: #f8fafc;">
                        <input type="file" name="image" class="form-control form-control-sm border-0 bg-transparent" style="font-size: 0.7rem;">
                    </div>

                <div class="mb-3">
    <label class="form-label fw-bold text-dark mb-1" style="font-size: 0.7rem;">Serial Number / IMEI (Optional)</label>
    <div class="p-2" style="border: 1px solid #e2e8f0; border-radius: 8px; background: #f8fafc;">
        <input type="text" 
               name="serial_number" 
               class="form-control form-control-sm border-0 bg-transparent" 
               placeholder="Example: SN123456789" 
               style="font-size: 0.7rem; box-shadow: none;"oninput="this.value = this.value.toUpperCase()">
    </div>
    <p class="mt-1 mb-0 text-muted" style="font-size: 0.65rem;">
        <i class="bi bi-info-circle me-1"></i> Highly recommended for electronic items for accurate verification purposes.
    </p>
</div>
                </div>

                <button type="submit" class="btn w-100 fw-bold py-2 text-white shadow-sm" style="background: #f6ad55; border: none; border-radius: 8px; font-size: 0.8rem;">
                    Submit Report
                </button>
            </form>
        </div>

        <div style="width: 45%; background: #ffffff; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 30px;">
            <img src="{{ asset('images/leftside.jpeg') }}" alt="Lost Illustration" style="width: 100%; max-width: 250px; height: auto; object-fit: contain;">
            <div class="mt-3 text-center px-3">
                <p class="text-muted" style="font-size: 0.7rem; line-height: 1.4;">
                    Describe the lost item and provide as many details as possible to increase the chance of recovery.
                </p>
            </div>
        </div>

    </div>
</div>

<style>
    /* Scrollbar nipis dan kemas */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f8fafc;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }
    .bg-light {
        background-color: #f8fafc !important;
    }
</style>
@endsection