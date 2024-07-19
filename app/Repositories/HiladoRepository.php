<?php

namespace App\Repositories;

use App\Interfaces\HiladoRepositoryInterface;
use App\Models\Hilado;
use Illuminate\Support\Facades\DB;

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

    public function filters(array $filters, $perPage)
    {
        # query permite construir la consulta
        $query = Hilado::query();

        # Filtro por descripción
        if (isset($filters['descripcion'])) {
            $query->where('descripcion', 'LIKE', '%' . $filters['descripcion'] . '%');
        }

        # Filtro por título de hilado
        if (isset($filters['titulo_hilado'])) {
            $query->where('titulo_hilado', 'LIKE', '%' . $filters['titulo_hilado'] . '%');
        }

        # Filtro por tipo de fibra
        if (isset($filters['tipo_fibra'])) {
            $query->whereExists(function ($subQuery) use ($filters) {
                $subQuery->select(DB::raw(1))
                    ->from('tipofibras')
                    ->whereRaw('tipofibras.id = hilados.id_tipofibra')
                    ->where('tipofibras.descripcion', 'LIKE', '%' . $filters['tipo_fibra'] . '%');
            });
        }

        # Filtro por costo
        if (isset($filters['costo_por_kg'])) {
            $query->whereExists(function ($subQuery) use ($filters) {
                $subQuery->select(DB::raw(1))
                    ->from('hiladosproveedors as hp')
                    ->whereRaw('hp.id_hilado = hilados.id')
                    ->whereRaw('hp.costo_por_kg = (
                        SELECT MAX(hp2.costo_por_kg)
                        FROM hiladosproveedors hp2
                        WHERE hp2.id_hilado = hilados.id
                    )')
                    ->where('hp.costo_por_kg', '<=', $filters['costo_por_kg']);
            });
        }

        # Filtro por nombre de proveedor
        if (isset($filters['proveedor'])) {
            $query->whereExists(function ($subQuery) use ($filters) {
                $subQuery->select(DB::raw(1))
                    ->from('hiladosproveedors as hp')
                    ->join('proveedors as p', 'hp.id_proveedor', '=', 'p.id')
                    ->whereRaw('hp.id_hilado = hilados.id')
                    ->whereRaw('hp.costo_por_kg = (
                             SELECT MAX(hp2.costo_por_kg)
                             FROM hiladosproveedors hp2
                             WHERE hp2.id_hilado = hilados.id
                         )')
                    ->where('p.descripcion', 'LIKE', '%' . $filters['proveedor'] . '%');
            });
        }

        // Verificar consulta generada
        // dd($query->toSql(), $query->getBindings());

        return $query->paginate($perPage);
    }
}
