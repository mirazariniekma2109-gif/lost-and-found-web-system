<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LostItem;
use App\Models\FoundItem;
use Illuminate\Support\Facades\Auth;

class MatchesController extends Controller
{
    /**
     * Papar senarai padanan (Matches) untuk user semasa
     */
    public function index()
    {
        $userId = Auth::id();

        // 1. Ambil semua barang hilang (Lost Items) yang dilaporkan oleh user ini
        $myLostItems = LostItem::where('user_id', $userId)->get();

        // 2. Jika user tak ada lapor barang hilang, kita hantar koleksi kosong
        if ($myLostItems->isEmpty()) {
            return view('matches', [
                'matches' => collect([]),
                'message' => 'You haven\'t reported any lost items yet.'
            ]);
        }

        /**
         * 3. LOGIK PADANAN:
         * Kita cari dalam table FoundItem di mana nama barang 'LIKE' (seakan-akan) 
         * dengan mana-mana item_name dalam senarai Lost Items user tadi.
         */
        $matches = FoundItem::where(function($query) use ($myLostItems) {
            foreach ($myLostItems as $lostItem) {
                // Mencari persamaan nama (Contoh: "Wallet" akan match dengan "Brown Wallet")
                $query->orWhere('item_name', 'LIKE', '%' . $lostItem->item_name . '%');
            }
        })
        ->with('user') // Ambil data user yang jumpa barang tu sekali
        ->latest()
        ->get();

        return view('matches', compact('matches'));
    }
}