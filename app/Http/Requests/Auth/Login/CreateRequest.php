<?php

namespace App\Http\Requests\Auth\Login;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'phone_number' => ['required', 'string', 'exists:users'],
            'password' => ['required', 'string']
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'phone_number.exists' => 'Номер телефона неверен'
        ];
    }
}
