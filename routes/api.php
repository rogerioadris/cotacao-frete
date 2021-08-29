<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CotacaoController;
use App\Http\Controllers\TransportadoraController;

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

Route::get('/transportadora', [TransportadoraController::class, 'listar']);
Route::get('/cotacao', [CotacaoController::class, 'listar']);
Route::post('/cotacao', [CotacaoController::class, 'cadastro']);
Route::put('/cotacao', [CotacaoController::class, 'consulta']);
