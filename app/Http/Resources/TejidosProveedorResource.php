<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TejidosProveedorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'id_tejido' => $this->id_tejido,
            'id_proveedor' => $this->id_proveedor,
            'costo_por_kg' => $this->costo_por_kg,
            'vigencia' => $this->vigencia,
        ];
    }
}
