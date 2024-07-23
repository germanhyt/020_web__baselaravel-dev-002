<?php

namespace App\Repositories;

use App\Interfaces\TejidosProveedorRepositoryInterface;
use App\Models\Tejidoshilado;
use App\Models\Tejidosproveedor;

class TejidosProveedorRepository implements TejidosProveedorRepositoryInterface
{

    public function getAll()
    {
        return Tejidosproveedor::all();
    }

    public function getByTejido($id)
    {
        return Tejidosproveedor::where('id_tejido', $id)
            ->orderBy('vigencia', 'desc')
            ->get();
    }

    public function getById($id)
    {
        return Tejidosproveedor::findOrFail($id);
    }

    public function store(array $data)
    {
        return Tejidosproveedor::create($data);
    }

    public function storeArray(array $data)
    {
        return Tejidosproveedor::insert($data);
    }

    public function update(array $data, $id)
    {
        return Tejidosproveedor::whereId($id)->update($data);
    }

    public function updateArrayByTejido(array $data, $id)
    {
        Tejidoshilado::where('id_tejido', $id)->delete();

        return Tejidosproveedor::insert($data);
    }

    public function updatePartial($id, $data)
    {
        return Tejidosproveedor::whereId($id)->update($data);
    }

    public function destroy($id)
    {
        return Tejidosproveedor::destroy($id);
    }
}
    // public function getAll();
    // public function getByTejido($id);
    // public function getById($id);
    // public function store(array $data);
    // public function storeArray(array $data);
    // public function update(array $data, $id);
    // public function updateArrayByTejido(array $data, $id);
    // public function updatePartial($id, $data);
    // public function destroy($id);