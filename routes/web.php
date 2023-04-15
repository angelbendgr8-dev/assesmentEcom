<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Carts\CartList;
use App\Http\Livewire\Home;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', Home::class)->name('index');
    Route::get('/my_cart',CartList::class)->name('carts');
});

require __DIR__.'/auth.php';
