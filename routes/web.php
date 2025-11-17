<?php
// use App\Http\Controllers\CustomerController;
// use Illuminate\Support\Facades\Route;

// Route::get('/customers', [CustomerController::class, 'index']);
// Route::get('/customers/{id}', [CustomerController::class, 'show']);
// Route::post('/customers', [CustomerController::class, 'create']);
// Route::patch('/customers/{id}', [CustomerController::class, 'update']);
// Route::delete('/customers/{id}', [CustomerController::class, 'delete']);
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
