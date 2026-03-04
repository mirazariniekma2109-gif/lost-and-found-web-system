<?php

namespace App\Http\Controllers;

use App\Models\LostItem;
use App\Models\FoundItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf; // <--- PASTIKAN ADA INI

class LostItemController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();
        $myLostItems = LostItem::where('user_id', $userId)->latest()->get();
        $myFoundItems = FoundItem::where('user_id', $userId)->latest()->get();
        
        $unclaimedItems = \App\Models\FoundItem::where('status', 'unclaimed')->get();
        return view('dashboard', compact('myLostItems', 'myFoundItems', 'unclaimedItems'));
    }

    public function create()
    {
        return view('lost-item-form');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item_name'     => 'required|string|max:255',
            'category'      => 'required|string',
            'serial_number' => 'nullable|string|max:100',
            'location_lost' => 'required|string',
            'date_lost'     => 'required|date',
            'description'   => 'nullable|string',
            'image'         => 'nullable|image|max:5120',
        ]);

        $data = $validatedData;
        $data['user_id'] = Auth::id(); // Fix untuk user_id NULL

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('lost_items', 'public');
        }

        LostItem::create($data);

        return redirect()->route('dashboard')->with('success', 'Report has been submitted successfully!');
    }

    public function showMatches()
{
    $userId = Auth::id();

    // 1. Ambil semua kategori barang yang user ni laporkan hilang
    $userLostCategories = \App\Models\LostItem::where('user_id', $userId)->pluck('category');

    // 2. Cari barang dijumpa (Found Items) yang mempunyai kategori yang sama
    // Kita guna 'whereIn' supaya dia check semua kategori yang user ada
    $matches = \App\Models\FoundItem::whereIn('category', $userLostCategories)
                ->latest()
                ->get();

    return view('matches', compact('matches'));
}

public function downloadReport($foundItemId)
    {
        $foundItem = FoundItem::findOrFail($foundItemId);
        
        $data = [
            'title' => 'ITEM MATCH VERIFICATION REPORT',
            'date'  => date('d/m/Y h:i A'),
            'item'  => $foundItem,
        ];

        $pdf = Pdf::loadView('match-pdf', $data);
        
        return $pdf->download('Match_Report_' . $foundItem->item_name . '.pdf');
    }

public function checkMatches($lostItemId)
{
    $lostItem = LostItem::findOrFail($lostItemId);

    // Cari dalam table FoundItem
    $matches = FoundItem::where('category', $lostItem->category)
        ->where(function ($query) use ($lostItem) {
            $query->where('item_name', 'LIKE', '%' . $lostItem->item_name . '%')
                  ->orWhere('serial_number', $lostItem->serial_number);
        })
        ->get()
        ->map(function ($foundItem) use ($lostItem) {
    // Pastikan serial_number tak kosong sebelum banding
    $hasSerial = !empty($lostItem->serial_number) && !empty($foundItem->serial_number);

    if ($hasSerial && $lostItem->serial_number === $foundItem->serial_number) {
        $foundItem->match_status = 'High Match (Verified Serial Number)';
        $foundItem->match_color = 'success'; 
    } else {
        $foundItem->match_status = 'Potential Match';
        $foundItem->match_color = 'warning';
    }
    return $foundItem;
});

    
    return view('matches.index', compact('lostItem', 'matches'));
}

    public function destroy($id)
{
    $item = LostItem::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    
    // Padam gambar dari storage jika ada
    if ($item->image) {
        \Illuminate\Support\Facades\Storage::disk('public')->delete($item->image);
    }

    $item->delete();

    return redirect()->route('dashboard')->with('success', 'Report deleted successfully!');
}
}