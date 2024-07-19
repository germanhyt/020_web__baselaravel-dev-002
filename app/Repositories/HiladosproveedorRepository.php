<?php

namespace App\Repositories;

use App\Interfaces\HiladosproveedorRepositoryInterface;
use App\Models\Hiladosproveedor;
use Illuminate\Support\Facades\Log;

class HiladosproveedorRepository implements HiladosproveedorRepositoryInterface
{
    public function getAll()
    {
        return Hiladosproveedor::all();
    }

    public function getByHilado($id)
    {
        return Hiladosproveedor::where('id_hilado', $id)->get();
    }

    public function getById($id)
    {
        return Hiladosproveedor::findOrFail($id);
    }

    public function store(array $data)
    {
        return Hiladosproveedor::create($data);
    }

    public function storeArray(array $data)
    {
        // return Hiladosproveedor::create($data);
        return Hiladosproveedor::insert($data);
    }

    public function update(array $data, $id)
    {
        return Hiladosproveedor::whereId($id)->update($data);
    }

    public function updateArrayByHilado(array $data, $id)
    {
        // actualizar un array de objetos
        // return Hiladosproveedor::where('id_hilado', $id)->update($data);


        // foreach ($data as $item) {

        //     // Asumiendo que el array de datos no incluye más el 'id_hilado'
        //     $proveedores = Hiladosproveedor::where('id_hilado', $id)
        //         ->get();
        //     // echo ($proveedores);
        //     // die();


        //     if ($proveedores->isEmpty()) {
        //         Log::info("No se encontraron proveedores para id_hilado: $id, id_proveedor: " . $item['id_proveedor']);
        //     } else {
        //         Log::info("Proveedores encontrados: " . $proveedores->toJson());
        //     }

        //     foreach ($proveedores as $proveedor) {

        //         $proveedor->updateOrCreate([
        //             'costo_por_kg' => $item['costo_por_kg'],
        //             'vigencia' => $item['vigencia']
        //         ]);
        //     }
        // }
        // return true;
        Hiladosproveedor::where('id_hilado', $id)->delete();

        return Hiladosproveedor::insert($data);
    }

    public function updatePartial(array $data, $id)
    {
        return Hiladosproveedor::whereId($id)->update($data);
    }


    public function destroy($id)
    {
        return Hiladosproveedor::destroy($id);
    }
}
