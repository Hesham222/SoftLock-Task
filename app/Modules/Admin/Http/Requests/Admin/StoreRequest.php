<?php

namespace Admin\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|regex:/^[\pL\s\-]+$/u|min:4|max:191',
            'email' => 'required|email|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/|unique:admins|max:191',
            'phone' => 'required|string|regex:/^\+?\d+$/|unique:admins|min:10|max:15',
            'password' => 'required|alpha_num|max:191|min:6',
            'privilege' => 'required|in:super,manager'

        ];
    }
}
