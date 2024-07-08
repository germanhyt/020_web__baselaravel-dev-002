<?php

namespace App\Http\Controllers\api;

use App\Classes\ApiResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\HiladoRepositoryInterface;
use App\Models\Hilado;

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

        // dd($request->all());

        //filters with queryparams
        // $hilados = $this->hiladoRepositoryInterface->getPaginated($request->perPage);

        // if ($request->has('filter_descripcion')) {

        //     $hilados = $this->hiladoRepositoryInterface->filter('descripcion', $request->filter_descripcion, $request->perPage);
        // }

        // if ($request->has('filter_tipo_fibra')) {
        //     $hilados = $this->hiladoRepositoryInterface->filter('tipo_fibra', $request->filter_tipo_fibra, $request->perPage);
        // }

        // if ($request->has('filter_titulo_hilado')) {
        //     $hilados = $this->hiladoRepositoryInterface->filter('titulo_hilado', $request->filter_titulo_hilado, $request->perPage);
        // }

        // if ($request->has('filter_costo_por_kg')) {
        //     $hilados = $this->hiladoRepositoryInterface->filter('costo_por_kg', $request->filter_costo_por_kg, $request->perPage);
        // }

        // // para todos filters anteriores
        // if ($request->has('filter_descripcion') && $request->has('filter_tipo_fibra') && $request->has('filter_titulo_hilado') && $request->has('filter_costo_por_kg')){

        // }


        // Recolectar filtros del request
        $filters = [];

        if ($request->has('filter_descripcion')) {
            $filters['descripcion'] = $request->input('filter_descripcion');
        }

        if ($request->has('filter_tipo_fibra')) {
            $filters['tipo_fibra'] = $request->input('filter_tipo_fibra');
        }

        if ($request->has('filter_titulo_hilado')) {
            $filters['titulo_hilado'] = $request->input('filter_titulo_hilado');
        }

        if ($request->has('filter_costo_por_kg')) {
            $filters['costo_por_kg'] = $request->input('filter_costo_por_kg');
        }

        // Aplicar filtros si hay, de lo contrario obtener paginación por defecto
        if (!empty($filters)) {
            $hilados = $this->hiladoRepositoryInterface->filters($filters, $request->input('perPage'));
        } else {
            $hilados = $this->hiladoRepositoryInterface->getPaginated($request->input('perPage'));
        }

        $hiladosResponse = [
            'data' => $hilados->items(),
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

        // return ApiResponseHelper::sendResponse($hilado, '', 200);

        return response()->json($hilado);
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
