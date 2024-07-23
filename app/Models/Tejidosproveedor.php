<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tejidosproveedor extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tejido',
        'id_proveedor',
        'costo_por_kg',
        'vigencia'
    ];

    /**
     * Relación inversa 
     */
    public function tejido()
    {
        return $this->belongsTo(Tejido::class, 'id_tejido');
    }

    /**
     * Relación inversa
     */
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }
}
