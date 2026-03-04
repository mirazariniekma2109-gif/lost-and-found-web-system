<?php

namespace App\Http\Controllers;

use App\Models\FoundItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FoundItemController extends Controller
{
    /**
     * 1. Papar senarai semua barang yang dijumpai (Public Gallery)
     */
    public function index()
    {
        $foundItems = FoundItem::latest()->paginate(9); 
        return view('found-items-index', compact('foundItems'));
    }

    /**
     * 2. Papar borang lapor barang dijumpai
     */
    public function create()
    {
        return view('found-item-form');
    }

    /**
     * 3. Simpan data barang dijumpai ke database
     */
    public function store(Request $request)
    {
        // 1. Gabungkan semua validasi dalam satu array supaya data tak hilang
        $validatedData = $request->validate([
            'item_name'      => 'required|string|max:255',
            'category'       => 'required|string',
            'serial_number'  => 'nullable|string|max:100', 
            'location_found' => 'required|string|max:255',
            'date_found'     => 'required|date',
            'finder_contact' => 'required|string', // Sudah diwajibkan
            'description'    => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg|max:5120', 
        ]);

        // 2. Masukkan ID user yang sedang log masuk
        $validatedData['user_id'] = Auth::id();

        $validatedData['status'] = 'unclaimed'; // <--- TAMBAH INI

        // 3. Logik Simpan Gambar ke storage
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('found_items', 'public');
            $validatedData['image'] = $imagePath;
        }

        // 4. Proses simpan ke database menggunakan Try-Catch
        try {
            FoundItem::create($validatedData);
            return redirect()->route('dashboard')->with('success', 'Found report has been submitted successfully!');
            
        } catch (\Exception $e) {
            return back()->withErrors('Database Error: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * 4. Proses tuntutan (Claim) barang
     */
    public function claim($id)
{
    // 1. Cari barang tu
    $item = FoundItem::findOrFail($id);

    // 2. Tukar status dalam database
    $item->update([
        'status' => 'claimed'
    ]);

    // 3. Bina link WhatsApp
    $phoneNumber = ltrim($item->finder_contact, '0');
    $message = "Hi " . ($item->user->name ?? 'Finder') . ", I think the " . $item->item_name . " you found belongs to me.";
    $whatsappUrl = "https://wa.me/60" . $phoneNumber . "?text=" . urlencode($message);

    // 4. Redirect ke WhatsApp secara automatik
    return redirect()->away($whatsappUrl);
}
}