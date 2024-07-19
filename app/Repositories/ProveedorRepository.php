<?php

namespace App\Repositories;

use App\Interfaces\ProveedorRepositoryInterface;
use App\Models\Proveedor;

class ProveedorRepository implements ProveedorRepositoryInterface
{

    public function getAll()
    {
        return Proveedor::all();
    }
}
