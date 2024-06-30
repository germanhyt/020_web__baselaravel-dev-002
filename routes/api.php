<?php

use App\Http\Controllers\api\StudentController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/students', StudentController::class);
// Route::post("/students", [
//     StudentController::class, 'store'
// ]);
// Route::put("/students/{id}", [
//     studentController::class, 'update'
// ]);
// Route::patch("/students/{id}", [
//     studentController::class, 'updatePartial'
// ]);
// Route::delete("students/{id}", [
//     studentController::class, 'destroy'
// ]);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
