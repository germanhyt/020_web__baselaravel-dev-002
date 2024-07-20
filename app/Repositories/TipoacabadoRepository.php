<?php

namespace App\Repositories;

use App\Interfaces\TipoacabadoRepositoryInterface;
use App\Models\Tipoacabado;

class TipoacabadoRepository implements TipoacabadoRepositoryInterface
{

    public function getAll()
    {
        return Tipoacabado::all();
    }
}
