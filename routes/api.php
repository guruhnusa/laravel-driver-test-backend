<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\SignApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//register
Route::post('/register', [AuthController::class, 'register']);
//login
Route::post('/login', [AuthController::class, 'login']);
//logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
//create exam
Route::post('/create-exam', [ExamController::class, 'createExam'])->middleware('auth:sanctum');
//get exam by category
Route::get('/get-question-exam', [ExamController::class, 'getListSoalByCategory'])->middleware('auth:sanctum');
//answer
Route::post('/answers', [ExamController::class, 'answerQuestion'])->middleware('auth:sanctum');
//get exam result
Route::get('/get-score', [ExamController::class, 'calculateScoreByCategory'])->middleware('auth:sanctum');
//get exam result
Route::get('/get-all-score', [ExamController::class, 'getAllScore'])->middleware('auth:sanctum');
//get signs by category
Route::get('/get-signs', [SignApiController::class, 'getSignsByCategory'])->middleware('auth:sanctum');
