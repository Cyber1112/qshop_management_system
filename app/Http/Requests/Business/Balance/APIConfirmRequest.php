<?php

namespace App\Http\Requests\Business\Balance;

use Illuminate\Foundation\Http\FormRequest;

class APIConfirmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cash' => ['required', 'integer'],
            'card_id' => ['required'],
        ];
    }
}