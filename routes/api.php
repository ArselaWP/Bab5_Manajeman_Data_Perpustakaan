<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\MemberController;

// Endpoint otomatis untuk CRUD Books dan Members
Route::apiResource('books', BookController::class);
Route::apiResource('members', MemberController::class);
