<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\TipoacabadoRepositoryInterface;

class TipoacabadoController extends Controller
{
    //
    private TipoacabadoRepositoryInterface $tipoacabadoRepositoryI;

    public function __construct(TipoacabadoRepositoryInterface $tipoacabadoRepositoryI)
    {
        $this->tipoacabadoRepositoryI = $tipoacabadoRepositoryI;
    }

    public function index()
    {
        $tipoacabados = $this->tipoacabadoRepositoryI->getAll();

        return response()->json($tipoacabados, 200);
    }
}
