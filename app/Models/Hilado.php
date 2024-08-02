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
    public function tipofibra()
    {
        return $this->belongsTo(Tipofibra::class, 'id_tipofibra', 'id');
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
        return $this->hasMany(Hiladosproveedor::class, 'id_hilado');
    }

    /**
     * Relación Uno a Muchos con tabla TejidosHilado
     */
    public function tejidosHilados()
    {
        return $this->hasMany(Tejidoshilado::class, 'id_hilado');
    }
}
