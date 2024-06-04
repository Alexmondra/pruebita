<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoSolicitud extends Model
{
    protected $table="tipo_solicitudes";
    protected $fillable = ['nombre','imagen','activo'];
}
