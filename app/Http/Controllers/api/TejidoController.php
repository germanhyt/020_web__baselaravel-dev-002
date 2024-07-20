<?php

namespace App\Http\Controllers\Api;

use App\Classes\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Interfaces\TejidoRepositoryInterface;
use Illuminate\Http\Request;

class TejidoController extends Controller
{
    //

    private TejidoRepositoryInterface $tejidoRepositoryI;

    public function __construct(TejidoRepositoryInterface $tejidoRepositoryI)
    {
        $this->tejidoRepositoryI = $tejidoRepositoryI;
    }

    public function index()
    {
        $tejidos = $this->tejidoRepositoryI->getAll();

        // return response()->json($tejidos, 200);

        return ApiResponseHelper::sendResponse($tejidos, "Tejidos recuperados correctamente", 200);
    }

    public function show($id)
    {
        $tejido = $this->tejidoRepositoryI->getById($id);

        return response()->json($tejido, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $tejido = $this->tejidoRepositoryI->store($data);

        return response()->json($tejido, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $tejido = $this->tejidoRepositoryI->update($id, $data);

        return response()->json($tejido, 200);
    }

    public function destroy($id)
    {
        $tejido = $this->tejidoRepositoryI->destroy($id);

        return response()->json($tejido, 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $data = $request->all();

        $tejido = $this->tejidoRepositoryI->updatePartial($id, $data);

        return response()->json($tejido, 200);
    }
}
