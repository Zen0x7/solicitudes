<?php

use App\Http\Controllers\Api\SolicitudesController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;

Route::prefix('solicitudes')->group(function () {
    Route::get('/', [SolicitudesController::class, 'index']);

    Route::post('/', [SolicitudesController::class, 'store'])
        ->middleware([HandlePrecognitiveRequests::class]);

    Route::get('/{solicitud}', [SolicitudesController::class, 'show']);

    Route::match(['put', 'patch'], '/{solicitud}', [SolicitudesController::class, 'update'])
        ->middleware([HandlePrecognitiveRequests::class]);

    Route::delete('/{solicitud}', [SolicitudesController::class, 'destroy']);
});
