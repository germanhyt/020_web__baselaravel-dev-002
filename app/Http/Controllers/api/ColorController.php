<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\ColorRepositoryInterface;

class ColorController extends Controller
{
    //
    private ColorRepositoryInterface $colorRepository;

    public function __construct(ColorRepositoryInterface $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }

    public function index()
    {
        $colors = $this->colorRepository->getAll();


        $response = [];

        if (count($colors) > 0) {
            foreach ($colors as $color) {
                $response[] = [
                    'id' => $color->id,
                    'descripcion' => $color->descripcion,
                ];
            };
        }

        return response()->json($response, 200);
    }
}
