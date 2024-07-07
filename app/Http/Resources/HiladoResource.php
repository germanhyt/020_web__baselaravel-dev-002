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
     * *   @OA\Property(
     *         property="costo_por_kg",
     *         type="decimal",
     *         description="Costo por kilogramo del hilado"
     *     )
     * )
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'descripcion' => $this->descripcion,
            'tipo_fibra' => $this->tipo_fibra,
            'titulo_hilado' => $this->titulo_hilado,
            'costo_por_kg' => $this->costo_por_kg,
        ];
    }
}
