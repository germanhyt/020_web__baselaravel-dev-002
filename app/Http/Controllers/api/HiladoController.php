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

        //filters with queryparams
        $hilados = $this->hiladoRepositoryInterface->getPaginated($request->perPage);

        if ($request->has('descripcion')) {
            $hilados = $this->hiladoRepositoryInterface->filter('descripcion', $request->descripcion, $request->perPage);
        }

        if ($request->has('tipo_fibra')) {
            $hilados = $this->hiladoRepositoryInterface->filter('tipo_fibra', $request->tipo_fibra, $request->perPage);
        }

        if ($request->has('titulo_hilado')) {
            $hilados = $this->hiladoRepositoryInterface->filter('titulo_hilado', $request->titulo_hilado, $request->perPage);
        }

        if ($request->has('costo_por_kg')) {
            $hilados = $this->hiladoRepositoryInterface->filter('costo_por_kg', $request->costo_por_kg, $request->perPage);
        }

        return response()->json($hilados);
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

        return ApiResponseHelper::sendResponse($hilado, '', 200);
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
