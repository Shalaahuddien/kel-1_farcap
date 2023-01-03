<?php

use App\Http\Controllers\api\AspirationController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get("/aspiration", [AspirationController::class, "index"]);
Route::get("/aspiration/{id}", [AspirationController::class, "show"]);
Route::post("/aspiration", [AspirationController::class, "store"]);
Route::post("/aspiration/{id}", [AspirationController::class, "update"]);
Route::get("/aspiration/delete/{id}", [AspirationController::class, "destroy"]);


Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::get('/auth/logout', [AuthController::class, 'logout']);
