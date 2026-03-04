<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('lost_items', function (Blueprint $table) {
        $table->string('serial_number')->nullable()->after('category');
    });

    Schema::table('found_items', function (Blueprint $table) {
        $table->string('serial_number')->nullable()->after('category');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items_tables', function (Blueprint $table) {
            //
        });
    }
};
