<?php

namespace App\Repositories;

use App\Http\Requests\Solicitudes\IndexRequest;
use App\Http\Requests\Solicitudes\StoreRequest;
use App\Http\Requests\Solicitudes\UpdateRequest;
use App\Http\Resources\SolicitudResource;
use App\Models\Solicitud;

class SolicitudesRepository
{
    public static function index(IndexRequest $request)
    {
        $query = Solicitud::query()
            ->when($request->query('search'), fn ($query) => $query->where('document_no', 'like', "%{$request->query('search')}%"))
            ->orderBy($request->query('order_column', 'created_at'), $request->query('order_direction', 'desc'))
            ->paginate(10);

        return [
            'message' => 'Solicitudes obtenidas correctamente',
            'data' => SolicitudResource::collection($query),
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
            'data' => new SolicitudResource($solicitud),
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
