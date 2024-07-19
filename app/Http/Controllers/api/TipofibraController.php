<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\TipofibraRepositoryInterface;

class TipofibraController extends Controller
{
    //
    private TipofibraRepositoryInterface $tipofibraRepository;

    public function __construct(TipofibraRepositoryInterface $tipofibraRepository)
    {
        $this->tipofibraRepository = $tipofibraRepository;
    }


    public function index()
    {
        $tipofibras = $this->tipofibraRepository->getAll();

        $response = [];

        if (count($tipofibras) > 0) {
            foreach ($tipofibras as $tipofibra) {
                $response[] = [
                    'id' => $tipofibra->id,
                    'descripcion' => $tipofibra->descripcion,
                ];
            };
        }

        return response()->json($response, 200);
    }
}
