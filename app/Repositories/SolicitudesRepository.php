<?php

namespace App\Repositories;

use App\DTO\SolicitudDTO;
use App\Http\Requests\Solicitudes\StoreRequest;
use App\Http\Requests\Solicitudes\UpdateRequest;
use App\Models\Solicitud;

class SolicitudesRepository
{
    public static function index()
    {
        $query = Solicitud::paginate();

        $result = $query->map(fn (Solicitud $solicitud) => SolicitudDTO::fromModel($solicitud))
            ->toArray();

        return [
            'message' => 'Solicitudes obtenidas correctamente',
            'data' => $result,
            'meta' => [
                'total' => $query->total(),
                'current_page' => $query->currentPage(),
                'per_page' => $query->perPage(),
                'last_page' => $query->lastPage(),
                'from' => $query->firstItem(),
                'to' => $query->lastItem(),
            ],
        ];
    }

    public static function create(StoreRequest $request)
    {
        $solicitud = Solicitud::query()
            ->create([
                'document_no' => $request->input('numero_documento'),
            ]);

        return [
            'message' => 'Solicitud insertada correctamente',
            'data' => [
                'id' => $solicitud->id,
            ],
        ];
    }

    public static function show(Solicitud $solicitud)
    {
        return [
            'message' => 'Solicitud recuperada correctamente',
            'data' => SolicitudDTO::fromModel($solicitud),
        ];
    }

    public static function update(UpdateRequest $request, Solicitud $solicitud)
    {
        $solicitud->update([
            'status' => $request->input('estado'),
        ]);

        return [
            'message' => 'Solicitud actualizada correctamente',
        ];
    }

    public static function delete(Solicitud $solicitud)
    {
        $solicitud->delete();

        return [
            'message' => 'Solicitud eliminada correctamente',
        ];
    }
}
