<?php

namespace App\Http\Requests\Business\Schedule;

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
            'working_schedule_type' => ['required', 'string'],
            'work_start' => ['string', 'required'],
            'work_end' => ['string', 'required']
        ];
    }
}
