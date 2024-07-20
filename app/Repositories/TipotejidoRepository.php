<?php

namespace App\Repositories;

use App\Interfaces\TipotejidoRepositoryInterface;
use App\Models\Tipotejido;

class TipotejidoRepository implements TipotejidoRepositoryInterface
{

    public function getAll()
    {
        return Tipotejido::all();
    }
}
