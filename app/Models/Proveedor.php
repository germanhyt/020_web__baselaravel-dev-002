<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedors';

    protected $fillable = ['descripcion'];



    /**
     * Relación con tabla Hiladosproveedor
     */
    public function hiladosproveedors()
    {
        return $this->hasMany(Hiladosproveedor::class, 'id_proveedor');
    }
}
