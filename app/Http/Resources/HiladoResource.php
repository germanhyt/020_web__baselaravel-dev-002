<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HiladoResource extends JsonResource
{

    /**
     * @OA\Schema(
     *     schema="HiladoResource",
     *     type="object",
     *     @OA\Property(
     *         property="id",
     *         type="integer",
     *         description="Id of the hilado"
     *     ),   
     * *   @OA\Property(
     *         property="descripcion",
     *         type="string",
     *         description="Descripcion of the hilado"
     *     ),
     * *   @OA\Property(
     *         property="tipo_fibra",
     *         type="string",
     *         description="Tipo de fibra del hilado"
     *     ),
     * *   @OA\Property(
     *         property="titulo_hilado",
     *         type="string",
     *         description="Titulo del hilado"
     *     ),
     * )
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'descripcion' => $this->descripcion,
            'titulo_hilado' => $this->titulo_hilado,
            'id_tipofibra' => $this->id_tipofibra,
            'id_color' => $this->id_color,

            // 'tipo_fibra' => $this->tipo_fibra,
            // 'costo_por_kg' => $this->costo_por_kg,
        ];
    }
}
