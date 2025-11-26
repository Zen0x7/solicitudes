<?php

namespace App\DTO;

use App\Models\Solicitud;

class SolicitudDTO
{
    /**
     * Constructor
     */
    public function __construct(public int $id, public string $numero_documento, public string $estado, public string $fecha_creacion) {}

    /**
     * Create from model
     */
    public static function fromModel(Solicitud $solicitud): self
    {
        return new self($solicitud->id, $solicitud->document_no, $solicitud->status, $solicitud->created_at);
    }
}
