<?php

namespace App\Repositories;

use App\Interfaces\HiladoRepositoryInterface;
use App\Models\Hilado;

class HiladoRepository implements HiladoRepositoryInterface
{
    public function getAll()
    {
        return Hilado::all();
    }

    public function getById($id)
    {
        return Hilado::findOrFail($id);
    }

    public function store(array $data)
    {
        return Hilado::create($data);
    }

    public function update(array $data, $id)
    {
        return Hilado::whereId($id)->update($data);
    }

    public function delete($id)
    {
        return Hilado::destroy($id);
    }

    public function updatePartial(array $data, $id)
    {
        return Hilado::whereId($id)->update($data);
    }

    // pagination
    public function getPaginated($perPage)
    {
        return Hilado::paginate($perPage);
    }

    // filter
    public function filter($field, $query, $perPage)
    {
        return Hilado::where($field, 'like', '%' . $query . '%')->paginate($perPage);
    }
}
