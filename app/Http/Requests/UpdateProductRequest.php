<?php

namespace App\Http\Requests;


class UpdateProductRequest extends ProductRequest
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

    public function prepareForValidation()
    {
        $this->merge(['id' => $this->route('id')]);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return array_merge(
            [
                'id' => 'required'
            ],
            parent::rules()
        );
    }

    public function messages()
    {
        return array_merge(
            [
                'id.*' => 'Informe o produto que deseja atualizar',
            ],
            parent::messages()
        );
    }
}
