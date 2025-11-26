<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Solicitudes\StoreRequest;
use App\Http\Requests\Solicitudes\UpdateRequest;
use App\Models\Solicitud;
use App\Repositories\SolicitudesRepository;
use Illuminate\Http\JsonResponse;
use Throwable;

class SolicitudesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json(SolicitudesRepository::index());
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error durante la obtención de solicitudes',
                'error_code' => $e->getCode(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        try {
            return response()->json(SolicitudesRepository::create($request), 201);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error durante la creación de la solicitud',
                'error_code' => $e->getCode(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Solicitud $solicitud): JsonResponse
    {
        return response()->json(SolicitudesRepository::show($solicitud));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Solicitud $solicitud): JsonResponse
    {
        try {
            return response()->json(SolicitudesRepository::update($request, $solicitud));
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error durante la actualización de la solicitud',
                'error_code' => $e->getCode(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solicitud $solicitud): JsonResponse
    {
        try {
            return response()->json(SolicitudesRepository::delete($solicitud));
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error durante la eliminación de la solicitud',
                'error_code' => $e->getCode(),
            ], 500);
        }
    }
}
