<?php

namespace Admin\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FilterDateRequest extends FormRequest
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
            'start_date' => 'nullable|date|date_format:Y-m-d',
            'end_date' => 'nullable|required_with:start_date|date|date_format:Y-m-d|after:start_date'
        ];
    }
}
