<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';

    protected $fillable = [
        'user_id',
        'user_id_rpta',
        'tipo',
        'comentario',
        'observaciones',
        'fecha_envio',
        'estado',
        'archivo',
    ];

    protected $casts = [
        'fecha_envio' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
