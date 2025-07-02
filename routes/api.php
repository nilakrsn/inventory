<?php

use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\ExpandApiController;
use App\Http\Controllers\ProductApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//category
Route::get("/category", [CategoryApiController::class, 'index']);
Route::post("/category/create", [CategoryApiController::class, 'store']);
Route::get("/category/{id}", [CategoryApiController::class, 'show']);
Route::put("/category/update/{id}", [CategoryApiController::class, 'update']);
Route::delete("/category/delete/{id}", [CategoryApiController::class, 'destroy']);

//product
Route::get("/product", [ProductApiController::class, 'index']);
Route::post("/product/create", [ProductApiController::class, 'store']);
Route::get("/product/{id}", [ProductApiController::class, 'show']);
Route::put("/product/update/{id}", [ProductApiController::class, 'update']);
Route::delete("/product/delete/{id}", [ProductApiController::class, 'destroy']);

//expand
Route::get("/expand", [ExpandApiController::class, 'index']);
Route::post("/expand/create", [ExpandApiController::class, 'store']);
Route::get("/expand/{id}", [ExpandApiController::class, 'show']);
Route::put("/expand/update/{id}", [ExpandApiController::class, 'update']);
Route::delete("/expand/delete/{id}", [ExpandApiController::class, 'destroy']);

