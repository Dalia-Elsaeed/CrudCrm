<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Request;

Route::middleware('auth:sanctum')->get('/user', function(Request $request){
    return $request->user();
});
// Customers
Route::get('/customers', [CustomerController::class, 'index']);
Route::post('/createCustomer', [CustomerController::class, 'create']);
Route::get('/customers/{id}', [CustomerController::class, 'show']);
Route::patch('/updateCustomer/{id}', [CustomerController::class, 'update']);
Route::delete('/customers/{id}', [CustomerController::class, 'delete']); // أضفت id


Route::post('createUser', [UserController::class, 'create']);
