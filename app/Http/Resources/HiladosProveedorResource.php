<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HiladosProveedorResource extends JsonResource
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
            'id_hilado' => $this->idHilado,
            'id_proveedor' => $this->idProveedor,
            'costo_por_kg' => $this->costo_por_kg ?? 0,
            'vigencia' => $this->vigencia,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
