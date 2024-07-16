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
        "id_tipofibra",
        "titulo_hilado",
        "id_color",
    ];


    /**
     * Relación Inversa con tabla TipoFibra
     */
    public function tipoFibra()
    {
        return $this->belongsTo(TipoFibra::class, 'id_tipofibra');
    }

    /**
     * Relación Inversa con tabla Color
     */
    public function color()
    {
        return $this->belongsTo(Color::class, 'id_color');
    }

    /**
     * Relación Uno a Muchos con tabla HiladosProveedor
     */
    public function hiladosProveedores()
    {
        return $this->hasMany(HiladosProveedor::class, 'id_hilado');
    }
}
