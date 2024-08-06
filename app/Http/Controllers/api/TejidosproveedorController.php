<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\TejidosProveedorRepositoryInterface;
use Illuminate\Http\Request;

class TejidosproveedorController extends Controller
{
    private TejidosProveedorRepositoryInterface $tejidosProveedorRepositoryI;

    public function __construct(TejidosProveedorRepositoryInterface $tejidosProveedorRepositoryI)
    {
        $this->tejidosProveedorRepositoryI = $tejidosProveedorRepositoryI;
    }


    public function index()
    {

        $tejidosproveedor = $this->tejidosProveedorRepositoryI->getAll();

        return response()->json($tejidosproveedor);
    }

    public function showByTejido($id)
    {

        $tejidosproveedor = $this->tejidosProveedorRepositoryI->getByTejido($id);

        $response = [];

        if (count($tejidosproveedor) > 0) {
            foreach ($tejidosproveedor as $tejidoProveedor) {
                $response[] = [
                    'id' => $tejidoProveedor->id,
                    'id_tejido' => $tejidoProveedor->id_tejido,
                    'proveedor' => [
                        "id" => $tejidoProveedor->proveedor->id,
                        "descripcion" => $tejidoProveedor->proveedor->descripcion,
                    ],
                    'costo_por_kg' => $tejidoProveedor->costo_por_kg,
                    'vigencia' => $tejidoProveedor->vigencia,
                ];
            };
        }

        return response()->json($response, 200);
    }

    public function show($id)
    {
        $tejidosproveedor = $this->tejidosProveedorRepositoryI->getByTejido($id);

        return response()->json($tejidosproveedor, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $tejidosproveedor = $this->tejidosProveedorRepositoryI->store($data);

        return response()->json($tejidosproveedor, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $tejidosproveedor = $this->tejidosProveedorRepositoryI->update($data, $id);

        return response()->json($tejidosproveedor, 200);
    }

    public function updateArrayByTejido(Request $request, $id)
    {
        $data = $request->all();

        $tejidosproveedor = $this->tejidosProveedorRepositoryI->updateArrayByTejido($data, $id);

        return response()->json($tejidosproveedor, 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $data = $request->all();

        $tejidosproveedor = $this->tejidosProveedorRepositoryI->updatePartial($id, $data);

        return response()->json($tejidosproveedor, 200);
    }

    public function storeArray(Request $request)
    {
        $data = $request->all();

        $tejidosproveedor = $this->tejidosProveedorRepositoryI->storeArray($data);

        return response()->json($tejidosproveedor, 201);
    }

    public function destroy($id)
    {
        $tejidosproveedor = $this->tejidosProveedorRepositoryI->destroy($id);

        return response()->json($tejidosproveedor, 200);
    }
}
