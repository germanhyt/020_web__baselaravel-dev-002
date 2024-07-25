<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tejido extends Model
{
    use HasFactory;

    protected $table = "tejidos";

    protected $fillable = [
        "descripcion",
        "galga",
        "diametro",
        "agujas",
        "ancho",
        "densidad",
        "densidadgw",
        "encogimientolargo",
        "encogimientoancho",
        "revirado",
        "id_tipoacabado",
        "id_tipotejido",
        "antipilling",
        "costo_por_kg",
        "ficha"
    ];

    /**
     * Relación Inversa 
     */
    public function tipotejido()
    {
        return $this->belongsTo(Tipotejido::class, 'id_tipotejido');
    }

    /**
     * Relación Inversa 
     */
    public function tipoacabado()
    {
        return $this->belongsTo(Tipoacabado::class, 'id_tipoacabado');
    }

    /**
     * Relación Uno a Muchos
     */
    public function tejidoshilados()
    {
        return $this->hasMany(Tejidoshilado::class, 'id_tejido');
    }

    /**
     * Relación Uno a Muchos
     */
    public function tejidosproveedores()
    {
        return $this->hasMany(Tejidosproveedor::class, 'id_tejido');
    }
}
