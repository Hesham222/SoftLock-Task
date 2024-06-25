<?php

namespace Admin\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $id = $this->route('admin');
        return [
            'name' => 'required|string|regex:/^[\pL\s\-]+$/u|min:4|max:191',
            'email' => 'required|email|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/|max:191|unique:admins,email,' . $id,
            'phone' => 'required|string|regex:/^\+?\d+$/|min:10|max:15|unique:admins,phone,' . $id,
            'privilege' => 'required|in:super,manager'
        ];
    }
}
