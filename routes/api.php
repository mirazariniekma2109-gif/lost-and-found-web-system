<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LostItemController;

Route::get('/test', function () {
    return 'API OK';
});

Route::get('/lost-items', [LostItemController::class, 'index']);
