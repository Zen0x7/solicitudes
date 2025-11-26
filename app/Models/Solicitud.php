<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $document_no
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\SolicitudFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Solicitud newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Solicitud newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Solicitud query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Solicitud whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Solicitud whereDocumentNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Solicitud whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Solicitud whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Solicitud whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Solicitud extends Model
{
    /** @use HasFactory<\Database\Factories\SolicitudFactory> */
    use HasFactory;

    /**
     * Table where records are stored.
     *
     * @var string
     */
    protected $table = 'solicitudes';

    /**
     * Attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'document_no',
        'status',
    ];
}
