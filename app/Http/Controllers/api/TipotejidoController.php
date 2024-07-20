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

        return response()->json($tipotejidos, 200);
    }
}
