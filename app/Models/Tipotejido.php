<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipotejido extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = "tipotejidos";

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ["descripcion"];


    /*
    * Relación Uno a Muchos
    */
    public function tejidos()
    {
        return $this->hasMany(Tejido::class, 'id_tipotejido',  'id');
    }
}
