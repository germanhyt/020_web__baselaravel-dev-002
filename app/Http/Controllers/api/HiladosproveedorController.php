<?php

namespace App\Http\Controllers\Api;

use App\Classes\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Interfaces\HiladosproveedorRepositoryInterface;
use App\Models\Hiladosproveedor;
use Illuminate\Http\Request;

class HiladosproveedorController extends Controller
{
    //
    private HiladosproveedorRepositoryInterface $hiladosproveedorRepositoryI;

    public function __construct(HiladosproveedorRepositoryInterface $hiladosproveedorRepositoryI)
    {
        $this->hiladosproveedorRepositoryI = $hiladosproveedorRepositoryI;
    }

    public function index()
    {
        $hiladosProveedor = $this->hiladosproveedorRepositoryI->getAll();

        return response()->json($hiladosProveedor, 200);
    }

    public function showByHilado($id)
    {
        $hiladosProveedor = $this->hiladosproveedorRepositoryI->getByHilado($id);

        $response = [];
        if (count($hiladosProveedor) > 0) {
            foreach ($hiladosProveedor as $hiladoProveedor) {
                $response[] = [
                    'id' => $hiladoProveedor->id,
                    'id_hilado' => $hiladoProveedor->id_hilado,
                    // 'id_proveedor' => $hiladoProveedor->id_proveedor,
                    'proveedor' => [
                        "id" => $hiladoProveedor->proveedor->id,
                        "descripcion" => $hiladoProveedor->proveedor->descripcion,
                    ],
                    'costo_por_kg' => $hiladoProveedor->costo_por_kg,
                    'vigencia' => $hiladoProveedor->vigencia,
                    'created_at' => $hiladoProveedor->created_at,
                    'updated_at' => $hiladoProveedor->updated_at,
                ];
            };
        }

        return response()->json($response, 200);
    }

    public function show($id)
    {
        $hiladoProveedor = $this->hiladosproveedorRepositoryI->getById($id);

        return response()->json($hiladoProveedor, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $hiladoProveedor = $this->hiladosproveedorRepositoryI->store($data);

        return ApiResponseHelper::sendResponse($hiladoProveedor, 'HiladosProveedor created', 201);
    }

    // registrar array de objetos
    public function storeArray(Request $request)
    {
        $data = $request->all(); // Asegúrate de que los datos se reciben correctamente

        // var_dump($data);
        // die();
        $hiladosProveedor = $this->hiladosproveedorRepositoryI->storeArray($data);

        return ApiResponseHelper::sendResponse($hiladosProveedor, 'HiladosProveedor created', 201);
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();

        $hiladoProveedor = $this->hiladosproveedorRepositoryI->update($data, $id);

        return ApiResponseHelper::sendResponse($hiladoProveedor, 'HiladosProveedor updated', 200);
    }

    public function updateByHilado(Request $request, $id)
    {
        $data = $request->all();


        $hiladoProveedor = $this->hiladosproveedorRepositoryI->updateArrayByHilado($data, $id);


        return ApiResponseHelper::sendResponse($hiladoProveedor, 'HiladosProveedor updated', 200);
    }


    public function destroy($id)
    {
        $hiladoProveedor = $this->hiladosproveedorRepositoryI->destroy($id);

        return ApiResponseHelper::sendResponse($hiladoProveedor, 'HiladosProveedor deleted', 200);
    }


    public function updatePartial(Request $request, $id)
    {
        $data = $request->all();

        $hiladoProveedor = $this->hiladosproveedorRepositoryI->updatePartial($data, $id);

        return ApiResponseHelper::sendResponse($hiladoProveedor, 'HiladosProveedor updated', 200);
    }
}

// 'id_hilado',
// 'id_proveedor',
// 'costo_por_kg',
// 'vigencia'
