<?php

use App\Http\Controllers\Api\SolicitudesController;
use Illuminate\Support\Facades\Route;

Route::prefix('solicitudes')->group(function () {
    Route::get('/', [SolicitudesController::class, 'index']);
    Route::post('/', [SolicitudesController::class, 'store']);
    Route::get('/{solicitud}', [SolicitudesController::class, 'show']);
    Route::match(['put', 'patch'], '/{solicitud}', [SolicitudesController::class, 'update']);
    Route::delete('/{solicitud}', [SolicitudesController::class, 'destroy']);
});
