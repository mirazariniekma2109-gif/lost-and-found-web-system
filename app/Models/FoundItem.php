<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoundItem extends Model
{
    use HasFactory;

    // Tambah semua nama kolum yang kau nak simpan di sini
    protected $fillable = [
        'item_name',
        'category',
        'location_found',
        'date_found',
        'description',
        'image',
        'user_id',
        'finder_contact',
        'status'
    ];

    // TAMBAH KOD INI
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}