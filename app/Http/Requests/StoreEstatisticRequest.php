<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstatisticRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rp' => 'required|integer',
            'goles' => 'required|integer',
            'ganados' => 'required|integer',
            'perdidos' => 'required|integer',
            'faltas' => 'required|integer',
            'tr' => 'required|integer',
            'ta' => 'required|integer',
        ];
    }
}
