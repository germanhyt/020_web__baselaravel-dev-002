<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tejidoshilado extends Model
{
    use HasFactory;


    /**
     * Definimos el nombre de la tabla, que por convención es el nombre de la clase en plural
     * Es protegido para evitar que se modifique, ya que no se debe cambiar el nombre de la tabla
     */
    protected $table = 'tejidoshilados';

    /**
     * Definimos los campos que se pueden llenar con asignación masiva
     */
    protected $fillable = [
        'id_tejido',
        'id_hilado',
        'lm',
        'participacion',
    ];


    public function tejido()
    {
        return $this->belongsTo(Tejido::class, 'id_tejido');
    }

    public function hilado()
    {
        return $this->belongsTo(Hilado::class, 'id_hilado');
    }
}
