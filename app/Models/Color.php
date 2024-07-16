<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;


    protected $table = 'colors';

    protected $fillable = ['descripcion'];


    /**
     * Relación uno a muchos con tabla Hilado
     */
    public function hilados()
    {
        return $this->hasMany(Hilado::class, 'id_color');
    }
}
