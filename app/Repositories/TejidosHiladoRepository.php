<?php

namespace App\Repositories;

use App\Interfaces\TejidosHiladoRepositoryInterface;
use App\Models\Tejidoshilado;

class TejidosHiladoRepository implements TejidosHiladoRepositoryInterface
{

    // public function getAll();
    // public function getById($id);
    // public function store(array $data);
    // public function update($id, array $data);
    // public function destroy($id);
    // public function updatePartial($id, array $data);

    public function getall()
    {
        return Tejidoshilado::all();
    }

    public function getById($id)
    {
        return TejidosHilado::find($id);
    }

    public function getByTejido($id)
    {
        return TejidosHilado::where('id_tejido', $id)->get();
    }

    public function store($data)
    {
        return TejidosHilado::create($data);
    }

    public function update($id, $data)
    {
        return TejidosHilado::where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return TejidosHilado::destroy($id);
    }

    public function updatePartial($id, $data)
    {
        return TejidosHilado::where('id', $id)->update($data);
    }
}
