<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipofibra extends Model
{
    use HasFactory;

    protected $table = 'tipofibras';

    protected $fillable = ['descripcion'];


    /**
     * Relación uno a muchos con tabla Hilado
     */
    public function hilados()
    {
        return $this->hasMany(Hilado::class, 'id_tipofibra', 'id');
    }
}
