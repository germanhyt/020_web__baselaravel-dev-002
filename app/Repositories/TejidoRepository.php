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

    public function getPaginated($perPage)
    {
        return Tejido::paginate($perPage);
    }

    public function filters(array $filters, $perPage)
    {
        $query = Tejido::query();

        if (isset($filters['descripcion'])) {
            $query->where('descripcion', 'like', '%' . $filters['descripcion'] . '%');
        }

        if (isset($filters['densidad'])) {
            $query->where('densidad', '<=', $filters['densidad']);
        }

        if (isset($filters['densidadgw'])) {
            $query->where('densidadgw', '<=', $filters['densidadgw']);
        }

        if (isset($filters['galga'])) {
            $query->where('galga', '<=', $filters['galga']);
        }

        if (isset($filters['diametro'])) {
            $query->where('diametro', '<=', $filters['diametro']);
        }

        if (isset($filters['tipotejido'])) {
            $query->whereHas('tipotejido', function ($subQuery) use ($filters) {
                $subQuery->where('id', $filters['tipotejido']);
            });
        }
        // if (isset($filters['tipotejido'])) {
        //     $query->whereHas('tipotejido', function ($q) use ($filters) {
        //         $q->where('descripcion', 'like', '%' . $filters['tipotejido'] . '%');
        //     });
        // }

        return $query->paginate($perPage);
    }
}
