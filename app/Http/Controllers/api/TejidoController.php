<?php

namespace App\Http\Controllers\Api;

use App\Classes\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Interfaces\TejidoRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TejidoController extends Controller
{
    //

    private TejidoRepositoryInterface $tejidoRepositoryI;

    public function __construct(TejidoRepositoryInterface $tejidoRepositoryI)
    {
        $this->tejidoRepositoryI = $tejidoRepositoryI;
    }


    // PARA OBTENER ARCHIVOS
    public function downloadFile(Request $request)
    {
        $filename = $request->input('filename');
        $path = storage_path('app/public/files/' . $filename);
        // $path = storage_path('app/public/files/TEST_20240724235204.pdf');

        if (!file_exists($path)) {
            return ApiResponseHelper::sendResponse(null, "El archivo no existe", 404);
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    // PARA SUBIR ARCHIVOS
    public function uploadFile(Request $request)
    {
        // $file = $request->file('file');
        // $path = $file->store('public/files');
        // return response()->json(['path' => $path], 200);

        // Obtener el archivo del formulario
        $file = $request->file('file');

        // Obtener el nombre original del archivo sin la extensión
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        // Obtener la fecha y hora actual en formato que incluya año, mes, día, hora, minutos y segundos
        $timestamp = date('YmdHis');

        // Extraer la extensión del archivo original
        $extension = $file->getClientOriginalExtension();

        // Concatenar el nombre original con la fecha y hora actual y la extensión para formar el nuevo nombre del archivo
        $name = $originalName . '_' . $timestamp;
        $filename = $name . '.' . $extension;

        // Guardar el archivo en el disco con el nuevo nombre
        $path = $file->storeAs('public/files', $filename);

        return response()->json([
            'path' => $path,
            'name' => $name
        ], 200);
    }

    public function uploadFileByName(Request $request)
    {

        // upload del file y su nombre
        $file = $request->file('file');
        $path = $file->storeAs('public/files', $request->input('filename'));
        return response()->json(['path' => $path], 200);
    }

    public function index(Request $request)
    {
        // $tejidos = $this->tejidoRepositoryI->getAll();

        $filters = [];
        $tejidos = null;

        if ($request->has('filter_descripcion')) {
            $filters['descripcion'] = $request->input('filter_descripcion');
        }

        if ($request->has('filter_tipotejido')) {
            $filters['tipotejido'] = $request->input('filter_tipotejido');
        }

        if ($request->has('filter_densidad')) {
            $filters['densidad'] = $request->input('filter_densidad');
        }

        if ($request->has('filter_densidadgw')) {
            $filters['densidadgw'] = $request->input('filter_densidadgw');
        }

        if ($request->has('filter_galga')) {
            $filters['galga'] = $request->input('filter_galga');
        }

        if ($request->has('filter_diametro')) {
            $filters['diametro'] = $request->input('filter_diametro');
        }

        if (!empty($filters)) {
            $tejidos = $this->tejidoRepositoryI->filters($filters, $request->input('perPage'));
        } else {
            $tejidos = $this->tejidoRepositoryI->getPaginated($request->input('perPage'));
        }


        $tejidosItemsDto = collect($tejidos->items());

        $tejidosArrayDto = $tejidosItemsDto->map(function ($tejido) {
            // obtener el hilado con mayor participation de la tabla tejidoshilados

            $maxParticipacion = collect($tejido->tejidoshilados)->reduce(
                function ($carry, $item) {
                    if (!$carry || $item->participacion > $carry['participacion']) {
                        return [
                            'lm' => $item->lm,
                            'participacion' => $item->participacion,
                            'hilado' => [
                                'id' => $item->hilado->id,
                                'descripcion' => $item->hilado->descripcion,
                            ]
                        ];
                    }
                },
            );

            $maxVigencia = collect($tejido->tejidosproveedores)->reduce(
                function ($carry, $item) {
                    if (!$carry || $item->vigencia > $carry['vigencia']) {
                        return [
                            'costo_por_kg' => $item->costo_por_kg,
                            'vigencia' => $item->vigencia,
                            'proveedor' => [
                                'id' => $item->proveedor->id,
                                'descripcion' => $item->proveedor->descripcion,
                            ]
                        ];
                    }
                    return $carry;
                },
                null
            );

            return [
                'id' => $tejido->id,
                'descripcion' => $tejido->descripcion,
                'hilado' => [
                    'id' => $maxParticipacion['hilado']['id'] ?? null,
                    'descripcion' => $maxParticipacion['hilado']['descripcion'] ?? null,
                ],
                'galga' => $tejido->galga,
                'diametro' => $tejido->diametro,
                'agujas' => $tejido->agujas,
                'ancho' => $tejido->ancho,
                'densidad' => $tejido->densidad,
                'densidadgw' => $tejido->densidadgw,
                'encogimientolargo' => $tejido->encogimientolargo,
                'encogimientoancho' => $tejido->encogimientoancho,
                'revirado' => $tejido->revirado,
                'id_tipotejido' => $tejido->id_tipotejido,
                'tipotejido' => [
                    'id' => $tejido->tipotejido->id ?? null,
                    'descripcion' => $tejido->tipotejido->descripcion ?? null
                ],
                'id_tipoacabado' => $tejido->id_tipoacabado,
                'tipoacabado' => [
                    'id' => $tejido->tipoacabado->id ?? null,
                    'descripcion' => $tejido->tipoacabado->descripcion ?? null
                ],
                'antipilling' => $tejido->antipilling,
                'proveedor' => [
                    'id' => $maxVigencia['proveedor']['id'] ?? null,
                    'descripcion' => $maxVigencia['proveedor']['descripcion'] ?? null,
                ],
                'costo_por_kg' => $maxVigencia['costo_por_kg'] ?? 0,
                'vigencia' => $maxVigencia['vigencia'] ?? null,
                // 'costo_por_kg' => $tejido->costo_por_kg,
                'ficha' => $tejido->ficha,
            ];
        });

        $hiladosResponse = [
            'data' => $tejidosArrayDto ?? [],
            'from' => $tejidos->firstItem(),
            'to' => $tejidos->lastItem(),
            'perPage' => $tejidos->perPage(),
            'currentPage' => $tejidos->currentPage(),
            'lastPage' => $tejidos->lastPage(),
            'total' => $tejidos->total()
        ];

        // return ApiResponseHelper::sendResponse($tejidos, "Tejidos recuperados correctamente", 200);
        return response()->json($hiladosResponse, 200);
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
