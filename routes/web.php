<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\LostItemController;
use App\Http\Controllers\FoundItemController;
use App\Http\Controllers\MatchesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. LANDING PAGE ---
Route::get('/', [LostItemController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');


// --- 2. AUTHENTICATION (GUEST ONLY) ---
Route::middleware(['guest'])->group(function () {
    
    // REGISTER
    Route::get('/register', function () {
        return view('register');
    })->name('register');

    Route::post('/register', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    });

    // LOGIN
    Route::get('/login', function () {
        return view('login'); 
    })->name('login');

    Route::post('/login', function (Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home'); 
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    });
});


// --- 3. PROTECTED ROUTES (WAJIB LOGIN) ---
Route::middleware(['auth'])->group(function () {
    
    // HOME (frontpage.blade.php)
    Route::get('/home', function () {
        return view('frontpage');
    })->name('home');

    // LOGOUT
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing'); 
    })->name('logout');

    // DASHBOARD 
    // Pastikan function 'dashboard' wujud di LostItemController kau
    Route::get('/dashboard', [LostItemController::class, 'dashboard'])->name('dashboard');

    // --- MY MATCHES (Menggunakan MatchesController Baru) ---
    // Route ini akan memaparkan barang yang 'berjodoh'
    Route::get('/my-matches', [MatchesController::class, 'index'])->name('matches.index');
    // Route ini PENTING untuk logic High Match yang kita buat dalam LostItemController tadi
    Route::get('/matches/check/{id}', [LostItemController::class, 'checkMatches'])->name('matches.check');                                                            
     // --- LOST ITEMS ---
    Route::get('/lost-item-form', [LostItemController::class, 'create'])->name('lost.create');
    Route::post('/lost-item-store', [LostItemController::class, 'store'])->name('lost.store');
    Route::get('/lost-items', [LostItemController::class, 'index'])->name('items.index');

    // --- FOUND ITEMS ---
    Route::get('/found-item-form', [FoundItemController::class, 'create'])->name('found.create');
    Route::post('/found-item-store', [FoundItemController::class, 'store'])->name('found.store'); //
    Route::get('/found-items', [FoundItemController::class, 'index'])->name('found.index'); //

   // Tambah ini di bawah FOUND ITEMS group
   Route::get('/found-item/edit/{id}', [FoundItemController::class, 'edit'])->name('found.edit');
   Route::put('/found-item/update/{id}', [FoundItemController::class, 'update'])->name('found.update'); 
   
    // Route untuk proses claim barang
    Route::post('/claim-item/{id}', [App\Http\Controllers\FoundItemController::class, 'claim'])->name('claim.item');

    Route::get('/download-report/{id}', [LostItemController::class, 'downloadReport'])->name('match.report');

    // Route untuk Delete
    Route::delete('/lost-item/{id}', [LostItemController::class, 'destroy'])->name('lost.destroy');
    Route::delete('/found-item/{id}', [FoundItemController::class, 'destroy'])->name('found.destroy');
});