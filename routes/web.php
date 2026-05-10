<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommunityController;


Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/community', [CommunityController::class, 'index']);
    Route::post('/community/store', [CommunityController::class, 'store']);
});

Route::get('/dashboard', [ItemController::class, 'dashboard'])
    ->middleware(['auth'])
    ->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user/{id}', [ItemController::class, 'userProfile'])->name('user.profile');
});



Route::middleware(['auth'])->group(function () {

    Route::post('/items/store', [ItemController::class, 'store']);
    Route::get('/items/data', [ItemController::class, 'data']);
    Route::post('/items/like/{id}', [ItemController::class, 'like']);
Route::post('/items/comment/{id}', [ItemController::class, 'comment']);
Route::post('/items/claim/{id}', [ItemController::class, 'claimItem']);
Route::get('/search', [ItemController::class, 'search']);

});



Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/items', [AdminController::class, 'index']);
    Route::get('/admin/items/data', [AdminController::class, 'data']);

    Route::post('/admin/items/approve/{id}', [AdminController::class, 'approve']);
    Route::post('/admin/items/reject/{id}', [AdminController::class, 'reject']);
    Route::get('/admin/students', [AdminController::class, 'students']);
    Route::post('/community/store', [CommunityController::class, 'store'])
    ->middleware(['auth', 'admin']);

    Route::delete('/admin/items/delete/{id}', [AdminController::class, 'delete']);
    Route::post('/admin/items/solve/{id}', [AdminController::class, 'solve'])
    ->middleware(['auth', 'admin']);
    Route::get('/admin/claims', [AdminController::class, 'claims']);
    Route::post('/admin/claims/update/{id}', [AdminController::class, 'updateClaim']);
    Route::post('/admin/items/solve/{id}', [AdminController::class, 'solve'])
    
    ->middleware(['auth']);
});


require __DIR__.'/auth.php';