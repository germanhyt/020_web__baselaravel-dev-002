<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipoacabado extends Model
{
    use HasFactory;

    protected $table = "tipoacabados";

    protected $fillable = ["descripcion"];


    /*
    * Relación Uno a Muchos
    */
    public function tejidos()
    {
        return $this->hasMany(Tejido::class, 'id_tipoacabado',  'id');
    }
}
