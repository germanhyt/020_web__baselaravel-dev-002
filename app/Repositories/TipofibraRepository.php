<?php

namespace App\Repositories;

use App\Interfaces\TipofibraRepositoryInterface;
use App\Models\Tipofibra;

class TipofibraRepository implements TipofibraRepositoryInterface
{
    public function getAll()
    {
        return Tipofibra::all();
    }
}
