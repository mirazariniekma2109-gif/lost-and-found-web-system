<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostItem extends Model
{
    use HasFactory;

    // Ini kunci utama supaya user_id tak NULL lagi!
    protected $fillable = [
        'item_name',
        'category',
        'location_lost',
        'date_lost',
        'description',
        'image',
        'user_id'
    ];

    // Hubungan dengan User
    public function user() {
        return $this->belongsTo(User::class);
    }
}