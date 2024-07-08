<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaginationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    // Colotar filter antes de cada atributo que entre por ejemplo filter:description
    public function filters()
    {
        return [
            'filtes.descripcion' => 'descripcion',
            'filters.tipo_fibra' => 'tipo_fibra',
            'filters.titulo_hilado' => 'titulo_hilado',
            'filters.costo_por_kg' => 'costo_por_kg'
        ];
    }
}
