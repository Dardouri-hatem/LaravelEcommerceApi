<?php

use App\Http\Controllers\API\CategorieController;
use Illuminate\Support\Facades\Route;



Route::get("categories", [CategorieController::class, "index"])->name("categories");
Route::get("categories/{category}", [CategorieController::class, "show"])->name("categories.show");