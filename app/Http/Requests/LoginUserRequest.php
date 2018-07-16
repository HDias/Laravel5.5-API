<?php

namespace API\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    public function authorize()
    {
        $fields = ['email', 'password'];

        /**
         * Se não passar todos os valores exigidos no post lança Exceção
         */
        return verify_fields_request($fields, app('request')->all());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email|max:255',
            'password' => 'required||string|min:6|max:255',
        ];
    }
}
