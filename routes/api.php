<?php

use App\Http\Controllers\IssueController;
use App\Http\Controllers\ProjectController;
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

Route::post('/issues', [IssueController::class, 'store']);
Route::get('/issues/show/{id}', [IssueController::class, 'show']);
Route::patch('/issues/update/{id}', [IssueController::class, 'update']);
Route::delete('/issues/delete/{id}', [IssueController::class, 'destroy']);
Route::get('/issues/list', [IssueController::class, 'list']);