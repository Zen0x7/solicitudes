<?php

namespace App\Enums;

enum EstadoSolicitud: string
{
    case PENDIENTE = 'pendiente';
    case APROBADO = 'aprobado';
    case RECHAZADO = 'rechazado';
}
