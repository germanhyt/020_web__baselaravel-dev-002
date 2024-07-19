<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\ProveedorRepositoryInterface;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    //

    private ProveedorRepositoryInterface $proveedorRepositoryI;

    public function __construct(ProveedorRepositoryInterface $proveedorRepositoryI)
    {
        $this->proveedorRepositoryI = $proveedorRepositoryI;
    }

    public function index()
    {
        $proveedores = $this->proveedorRepositoryI->getAll();

        $response = [];

        foreach ($proveedores as $proveedor) {
            $response[] = [
                'id' => $proveedor->id,
                'descripcion' => $proveedor->descripcion,
            ];
        }

        return response()->json($response, 200);
    }
}
