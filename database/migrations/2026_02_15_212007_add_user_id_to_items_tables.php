<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah kat table lost_items
        Schema::table('lost_items', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id');
        });

        // Tambah kat table found_items
        Schema::table('found_items', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('lost_items', function (Blueprint $table) { $table->dropColumn('user_id'); });
        Schema::table('found_items', function (Blueprint $table) { $table->dropColumn('user_id'); });
    }
};