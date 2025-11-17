<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

// Customers
Route::get('/customers', [CustomerController::class, 'index']);
Route::post('/createCustomer', [CustomerController::class, 'create']);
Route::get('/customers/{id}', [CustomerController::class, 'show']);
Route::patch('/updateCustomer/{id}', [CustomerController::class, 'update']);
Route::delete('/customers/{id}', [CustomerController::class, 'delete']);

// Notes
Route::get('/customers/{customerId}/notes', [NoteController::class, 'index']);
Route::post('/customers/{customerId}/notes', [NoteController::class, 'create']);
Route::get('/customers/{customerId}/notes/{id}', [NoteController::class, 'show']);
Route::patch('/customers/{customerId}/notes/{id}', [NoteController::class, 'update']);
Route::delete('/customers/{customerId}/notes/{id}', [NoteController::class, 'delete']);

Route::Post(uri: 'users');
