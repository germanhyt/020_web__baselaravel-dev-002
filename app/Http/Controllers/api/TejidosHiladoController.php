<?php

namespace App\Http\Controllers\Api;

use App\Classes\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Interfaces\TejidosHiladoRepositoryInterface;
use Illuminate\Http\Request;

class TejidosHiladoController extends Controller
{
    //
    private TejidosHiladoRepositoryInterface $tejidosHiladoRepositoryI;

    public function __construct(TejidosHiladoRepositoryInterface $tejidosHiladoRepositoryI)
    {
        $this->tejidosHiladoRepositoryI = $tejidosHiladoRepositoryI;
    }

    public function index()
    {
        $tejidosHilado = $this->tejidosHiladoRepositoryI->getAll();

        return ApiResponseHelper::sendResponse($tejidosHilado, "Tejidos Hilado retrieved successfully", 200);
    }

    public function showByTejido($id)
    {
        $tejidosHilado = $this->tejidosHiladoRepositoryI->getByTejido($id);
        $response = [];


        if (count($tejidosHilado) > 0) {
            foreach ($tejidosHilado as $tejidoHilado) {

                $maxVigencia = collect($tejidoHilado->hilado->hiladosProveedores)->reduce(function ($carry, $item) {
                    if (!$carry || $item->vigencia > $carry['vigencia']) {
                        return [
                            'costo_por_kg' => $item->costo_por_kg,
                            'vigencia' => $item->vigencia,
                            'proveedor' => [
                                "id" => $item->proveedor->id,
                                "descripcion" => $item->proveedor->descripcion
                            ],
                        ];
                    }
                    return $carry;
                }, null);


                // respuesta de la tabla intermedia
                $response[] = [
                    'id' => $tejidoHilado->id,
                    'id_tejido' => $tejidoHilado->id_tejido,
                    'id_hilado' => $tejidoHilado->id_hilado,
                    'hilado' => [
                        'id' => $tejidoHilado->hilado->id,
                        'descripcion' => $tejidoHilado->hilado->descripcion,
                        'tipofibra' => $tejidoHilado->hilado->tipoFibra->descripcion,
                        'titulo' => $tejidoHilado->hilado->titulo_hilado,
                        'color' => $tejidoHilado->hilado->color ? $tejidoHilado->hilado->color->descripcion : null,
                        'proveedor' => [
                            "id" => $maxVigencia['proveedor']['id'] ?? null,
                            "descripcion" => $maxVigencia['proveedor']['descripcion'] ?? null,
                        ],
                        'costo_por_kg' => $maxVigencia['costo_por_kg'] ?? null,
                        'vigencia' => $maxVigencia['vigencia'] ?? null,
                    ],
                    'participacion' => $tejidoHilado->participacion,
                    'lm' => $tejidoHilado->lm,
                ];
            }
        }

        return response()->json($response, 200);
    }

    public function show($id)
    {
        $tejidosHilado = $this->tejidosHiladoRepositoryI->getById($id);

        return response()->json($tejidosHilado, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $tejidosHilado = $this->tejidosHiladoRepositoryI->store($data);

        return response()->json($tejidosHilado, 201);
    }


    public function storeArray(Request $request)
    {
        $data = $request->all();

        $tejidosproveedor = $this->tejidosHiladoRepositoryI->storeArray($data);

        return response()->json($tejidosproveedor);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $tejidosHilado = $this->tejidosHiladoRepositoryI->update($id, $data);

        return response()->json($tejidosHilado, 200);
    }

    public function updateByTejido(Request $request, $id)
    {
        $data = $request->all();

        $tejidosHilado = $this->tejidosHiladoRepositoryI->updateByTejido($data, $id);

        return response()->json($tejidosHilado, 200);
    }

    public function destroy($id)
    {
        $tejidosHilado = $this->tejidosHiladoRepositoryI->destroy($id);

        return response()->json($tejidosHilado, 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $data = $request->all();

        $tejidosHilado = $this->tejidosHiladoRepositoryI->updatePartial($id, $data);

        return response()->json($tejidosHilado, 200);
    }
}
