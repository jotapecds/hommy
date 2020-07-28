<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Republic;

class RepublicRequest extends FormRequest
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
            'name'=>'required',
            'street'=>'required',
            'number'=>'required|integer',
            'district'=>'required',
            'city'=>'required',
            'state'=>'required',
            'cep'=>'required',
            'price'=>'required|numeric'
        ];
    }

    public function messages() {
        return [
            'name.required'=>'Insira o nome da sua república',
            'street.required'=>'Insira a rua',
            'number.required'=>'Insira o número',
            'number.integer'=>'Insira um número válido',
            'district.required'=>'Insira o bairro',
            'city.required'=>'Insira a cidade',
            'state.required'=>'Insira o estado',
            'cep.required'=>'Insira um cep',
            'price.required'=>'Insira um nome',
            'price.numeric'=>'Insira um valor válido',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(),422));
    }

}
