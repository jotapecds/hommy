<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\User;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:Users,email',
            'password' => 'required|min:8',
            'tel_num' => 'nullable|numeric|min:9',
            'birth_date' => 'required|date_format:d/m/Y',
            'is_locator' => 'boolean',
        ];
    }

    public function messages() {
        return [
            'name.required'=>'Insira o seu nome',
            'email.required'=>'Insira o seu email',
            'email.email'=>'Formato do email inválido',
            'email.unique'=>'Email já cadastrado',
            'password.required'=>'Insira sua senha',
            'password.min'=>'Insira um minimo de caracteres na sua senha',
            'birth_date.required'=>'Insira sua data de nascimento'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(),422));
    }

}
