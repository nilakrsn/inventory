<?php

use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\ExpandApiController;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\StockInApiController;
use App\Http\Controllers\StockOutApiController;
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

//stock in
Route::get("/stockin", [StockInApiController::class, 'index']);
Route::post("/stockin/create", [StockInApiController::class, 'store']);
Route::get("/stockin/{id}", [StockInApiController::class, 'show']);
Route::put("/stockin/update/{id}", [StockInApiController::class, 'update']);
Route::delete("/stockin/delete/{id}", [StockInApiController::class, 'destroy']);

//stock out
Route::get("/stockout", [StockOutApiController::class, 'index']);
Route::post("/stockout/create", [StockOutApiController::class, 'store']);
Route::get("/stockout/{id}", [StockOutApiController::class, 'show']);
Route::put("/stockout/update/{id}", [StockOutApiController::class, 'update']);
Route::delete("/stockout/delete/{id}", [StockOutApiController::class, 'destroy']);