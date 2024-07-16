<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hiladosproveedor extends Model
{
    use HasFactory;

    protected $table = 'hiladosproveedors';

    protected $fillable = [
        'id_hilado',
        'id_proveedor',
        'costo_por_kg',
        'vigencia'
    ];

    /**
     * Relación Inversa con tabla Hilado
     */
    public function hilado()
    {
        return $this->belongsTo(Hilado::class, 'id_hilado');
    }

    /**
     * Relación Inversa con tabla Proveedor
     */
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }
}
