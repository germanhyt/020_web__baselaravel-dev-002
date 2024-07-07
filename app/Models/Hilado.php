<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hilado extends Model
{
    use HasFactory;


    /**
     * The table associated with the model.
     */
    protected $table = "hilados";

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "descripcion",
        "tipo_fibra",
        "titulo_hilado",
        "costo_por_kg",
    ];
}
