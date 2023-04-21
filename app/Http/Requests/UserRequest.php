<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $rules          = [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|max:255|unique:users,email,'.$this->user,
            'password'  => 'nullable|confirmed',
        ];

        if($this->method()      == 'POST'){
            $rules['password']  = 'required|confirmed';
        }

        return $rules;
    }
}
