
<?php

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

Route::apiResource('/files', App\Http\Controllers\Api\FileController::class);
Route::apiResource('/folders', App\Http\Controllers\Api\FolderController::class);
Route::apiResource('/subfolders', App\Http\Controllers\Api\SubFolderController::class);
