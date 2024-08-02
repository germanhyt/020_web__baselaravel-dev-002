<?php

namespace App\Http\Controllers\api;

use App\Classes\ApiResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\HiladoRepositoryInterface;


/**
 * @OA\Server(url="http://localhost:8000")
 */
class HiladoController extends Controller
{
    //
    private HiladoRepositoryInterface $hiladoRepositoryInterface;

    public function __construct(HiladoRepositoryInterface $hiladoRepositoryInterface)
    {
        $this->hiladoRepositoryInterface = $hiladoRepositoryInterface;
    }


    // pagination method with queryparams as page and perPerga
    public function index(Request $request)
    {

        $filters = [];
        $hilados = null;


        if ($request->has('filter_descripcion')) {
            $filters['descripcion'] = $request->input('filter_descripcion');
        }

        if ($request->has('filter_tipo_fibra')) {
            $filters['tipo_fibra'] = $request->input('filter_tipo_fibra');
        }

        if ($request->has('filter_titulo_hilado')) {
            $filters['titulo_hilado'] = $request->input('filter_titulo_hilado');
        }

        // if ($request->has('filter_costo_por_kg')) {
        //     $filters['costo_por_kg'] = $request->input('filter_costo_por_kg');
        // }
        if ($request->has('filter_costo_por_kg_min')) {
            $filters['costo_por_kg_min'] = $request->input('filter_costo_por_kg_min');
        }
        if ($request->has('filter_costo_por_kg_max')) {
            $filters['costo_por_kg_max'] = $request->input('filter_costo_por_kg_max');
        }


        if ($request->has('filter_proveedor')) {
            $filters['proveedor'] = $request->input('filter_proveedor');
        }

        // Aplicar filtros si hay, de lo contrario obtener paginación por defecto
        if (!empty($filters)) {
            $hilados = $this->hiladoRepositoryInterface->filters($filters, $request->input('perPage'));
        } else {
            $hilados = $this->hiladoRepositoryInterface->getPaginated($request->input('perPage'));
        }


        // 1ra forma de manejar el array de hilados
        // $hilados_array_dto = $hilados->items();
        // $hilados_array_dto_aux = [];
        // foreach ($hilados_array_dto as $hilado) {
        //     $maxCostProvider = null;
        //     $maxCost = 0;
        //     foreach ($hilado->hiladosProveedores as $hiladoProveedor) {
        //         if ($hiladoProveedor->costo_por_kg > $maxCost) {
        //             $maxCost = $hiladoProveedor->costo_por_kg;
        //             $maxCostProvider = [
        //                 "id" => $hiladoProveedor->proveedor->id,
        //                 "descripcion" => $hiladoProveedor->proveedor->descripcion
        //             ];
        //         }
        //     }

        //     $hilados_array_dto_aux[] = [
        //         'id' => $hilado->id,
        //         'descripcion' => $hilado->descripcion ?? null,
        //         'titulo' => $hilado->titulo_hilado ?? null,
        //         "tipofibra" => $hilado->tipoFibra->descripcion ?? null,
        //         "color" => $hilado->color->descripcion ?? null,
        //         "proveedor" => $maxCostProvider ?? null,
        //         "costo_por_kg" => $maxCost ?? null
        //     ];
        // }
        // $hilados_array_dto = $hilados_array_dto_aux;


        // 2da forma de manejar el array de hilados
        // Por concepto collect es un método de laravel que convierte una colección en un array
        // el siguiente código es para obtener el proveedor con el costo por kg más alto
        $hiladosItemsDto = collect($hilados->items());

        $hiladosArrayDto = $hiladosItemsDto->map(function ($hilado) {

            // para obtener el proveedor con el costo por kg más alto
            // $maxCostProvider = collect($hilado->hiladosProveedores)->reduce(function ($carry, $item) {
            //     if (!$carry || $item->costo_por_kg > $carry['costo_por_kg']) {
            //         return [
            //             'costo_por_kg' => $item->costo_por_kg,
            //             'vigencia' => $item->vigencia,
            //             'proveedor' => [
            //                 "id" => $item->proveedor->id,
            //                 "descripcion" => $item->proveedor->descripcion
            //             ],
            //         ];
            //     }
            //     return $carry;
            // }, null);

            $maxVigencia = collect($hilado->hiladosProveedores)->reduce(function ($carry, $item) {
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


            return [
                'id' => $hilado->id,
                'descripcion' => $hilado->descripcion ?? null,
                'titulo_hilado' => $hilado->titulo_hilado ?? null,
                'tipo_fibra' => $hilado->tipoFibra ? $hilado->tipoFibra->descripcion : null,
                'color' => $hilado->color ? $hilado->color->descripcion : null,
                'proveedor' => [
                    "id" => $maxVigencia['proveedor']['id'] ?? null,
                    "descripcion" => $maxVigencia['proveedor']['descripcion'] ?? null,
                ],
                "vigencia" => $maxVigencia['vigencia'] ?? null,
                'costo_por_kg' => $maxVigencia['costo_por_kg'] ?? 0,
                "updated_at" => $hilado->updated_at ?? null,
                "created_at" => $hilado->created_at ?? null
            ];
        });


        $hiladosResponse = [
            'data' => $hiladosArrayDto ?? [],
            'from' => $hilados->firstItem(),
            'to' => $hilados->lastItem(),
            'perPage' => $hilados->perPage(),
            'currentPage' => $hilados->currentPage(),
            'lastPage' => $hilados->lastPage(),
            'total' => $hilados->total()
        ];

        // return ApiResponseHelper::sendResponse($hiladosResponse, '', 200);
        return response()->json($hiladosResponse);
    }

    public function showAll()
    {
        $hilados = $this->hiladoRepositoryInterface->getAll();

        $response = [];

        if (count($hilados) > 0) {
            foreach ($hilados as $hilado) {
                $response[] = [
                    'id' => $hilado->id,
                    'descripcion' => $hilado->descripcion
                ];
            }
        }

        return response()->json($response, 200);
    }


    /**
     * @OA\Get(
     *      path="/hilados/{id}",
     *      operationId="getHiladoById",
     *      tags={"Hilados"},
     *      summary="Get hilado information",
     *      description="Returns hilado data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Hilado id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/HiladoResource")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Hilado not found"
     *      )
     * )
     */
    public function show($id)
    {
        $hilado = $this->hiladoRepositoryInterface->getById($id);


        $response = [
            'id' => $hilado->id,
            'descripcion' => $hilado->descripcion,
            'titulo_hilado' => $hilado->titulo_hilado,
            'id_tipofibra' => $hilado->id_tipofibra,
            "tipo_fibra" => $hilado->tipofibra ? $hilado->tipofibra->descripcion : null,
            'id_color' => $hilado->id_color ?? null,
            "color" => $hilado->color ? $hilado->color->descripcion : null
        ];


        return response()->json($response, 200);
        // return ApiResponseHelper::sendResponse($hilado, '', 200);
    }

    /**
     * @OA\Post(
     *      path="/hilados",
     *      operationId="storeHilado",
     *      tags={"Hilados"},
     *      summary="Store new hilado",
     *      description="Returns hilado data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/HiladoResource")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/HiladoResource")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Hilado validation error"
     *      )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $hilado = $this->hiladoRepositoryInterface->store($data);

        return ApiResponseHelper::sendResponse($hilado, 'Hilado created', 201);
    }


    /**
     * @OA\Put(
     *      path="/hilados/{id}",
     *      operationId="updateHilado",
     *      tags={"Hilados"},
     *      summary="Update existing hilado",
     *      description="Returns updated hilado data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Hilado id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/HiladoResource")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/HiladoResource")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Hilado not found"
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Hilado validation error"
     *      )
     * )
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $hilado = $this->hiladoRepositoryInterface->update($data, $id);

        return ApiResponseHelper::sendResponse($hilado, 'Hilado updated', 200);
    }

    /**
     * @OA\Delete(
     *      path="/hilados/{id}",
     *      operationId="deleteHilado",
     *      tags={"Hilados"},
     *      summary="Delete existing hilado",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Hilado id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="successful operation"
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Hilado not found"
     *      )
     * )
     */
    public function destroy($id)
    {
        $this->hiladoRepositoryInterface->delete($id);

        return ApiResponseHelper::sendResponse(null, 'Hilado deleted', 204);
    }

    /**
     * @OA\Patch(
     *      path="/hilados/{id}",
     *      operationId="updatePartialHilado",
     *      tags={"Hilados"},
     *      summary="Update existing hilado",
     *      description="Returns updated hilado data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Hilado id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/HiladoResource")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/HiladoResource")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Hilado not found"
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Hilado validation error"
     *      )
     * )
     */
    public function updatePartial(Request $request, $id)
    {
        $data = $request->all();
        $hilado = $this->hiladoRepositoryInterface->updatePartial($data, $id);

        return ApiResponseHelper::sendResponse($hilado, 'Hilado updated', 200);
    }
}
