<?php

use App\Http\Controllers\AlunoController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('aluno', 'App\Http\Controllers\AlunoController');

Route::apiResource('instrutor', 'App\Http\Controllers\InstrutorController');

Route::apiResource('matricula','App\Http\Controllers\MatriculaController');

Route::prefix('aluno')->group(function () {
    Route::get('/{idAluno}/matricula', [AlunoController::class, 'getMatricula']);
    Route::get('/{idPlano}/plano', [AlunoController::class, 'getPlano']);

});
