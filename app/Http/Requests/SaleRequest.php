<?php

namespace App\Http\Requests;

use Error;
use Illuminate\Validation\Rule;

class SaleRequest extends CustomertRequest
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
        return
            array_merge(
                parent::rules(),
                [
                    'product_id' => 'required|numeric|gt:0',
                    'discount' => 'numeric',
                    'amount' => 'required|numeric|gt:0',
                    'sold_at' => 'date',
                    'status' => ['required', Rule::in(['approved', 'canceled', 'returned'])]
                ]
            );
    }

    public function messages()
    {
        return array_merge(
            parent::messages(),
            [
                'product_id.*' => 'Selecione um produto',
                'discount.*' => 'O desconto deve ser numérico',
                'amount.*' => 'A quantidade é obrigatória',
                'sold_at.*' => 'A data da compra é obrigatória',
                'status.*' => 'Selecione um status'
            ]
        );
    }
}
