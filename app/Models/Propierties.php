<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propierties extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo_postal',
        'superficie_terreno',
        'superficie_construccion',
        'uso_construccion',
        'valor_unitario_suelo',
        'valor_suelo',
        'subsidio',
    ];
}
