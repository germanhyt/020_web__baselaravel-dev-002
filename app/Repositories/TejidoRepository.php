<?php

namespace App\Repositories;

use App\Interfaces\TejidoRepositoryInterface;
use App\Models\Tejido;

class TejidoRepository implements TejidoRepositoryInterface
{

    public function getAll()
    {
        return Tejido::all();
    }

    public function getById($id)
    {
        return Tejido::findOrFail($id);
    }

    public function store(array $data)
    {
        return Tejido::create($data);
    }

    public function update($id, array $data)
    {
        return Tejido::whereId($id)->update($data);
    }

    public function destroy($id)
    {
        return Tejido::destroy($id);
    }

    public function updatePartial($id, array $data)
    {
        return Tejido::whereId($id)->update($data);
    }
}
