<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('found_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');         // Nama barang yang dijumpai
            $table->string('category');          // Kategori (Phone, Wallet, etc)
            $table->string('location_found');    // Lokasi dijumpai
            $table->date('date_found');          // Tarikh dijumpai
            $table->text('description')->nullable(); // Info tambahan (warna, brand)
            $table->string('finder_contact');    // No tel/email orang yang jumpa
            $table->string('status')->default('available'); // available / claimed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('found_items');
    }
};