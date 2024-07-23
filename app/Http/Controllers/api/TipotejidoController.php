<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\TipotejidoRepositoryInterface;
use Illuminate\Http\Request;

class TipotejidoController extends Controller
{
    //
    private TipotejidoRepositoryInterface $tipotejidoRepositoryI;

    public function __construct(TipotejidoRepositoryInterface $tipotejidoRepositoryI)
    {
        $this->tipotejidoRepositoryI = $tipotejidoRepositoryI;
    }

    public function index()
    {
        $tipotejidos = $this->tipotejidoRepositoryI->getAll();

        $response = [];

        if (count($tipotejidos) > 0) {
            foreach ($tipotejidos as $tipotejido) {
                $response[] = [
                    'id' => $tipotejido->id,
                    'descripcion' => $tipotejido->descripcion,
                ];
            }
        }

        return response()->json($response, 200);
    }
}
