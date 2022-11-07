<?php

namespace App\Http\Requests\Admin\User;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required | string',
            'email' => 'required | string | email | unique:users, email' . $this->user_id,
            'user_id' => 'required | integer | exists:users,id',
            'role' => 'required | integer',
        ];
    }

    public function messages()
    {
        return [
          'name.required' => 'Це поле необхідно заповнити',
          'name.string' => 'Це поле повинне бути рядкового типу',
          'email.required' => 'Це поле необхідно заповнити',
          'email.string' => 'Це поле повинне бути рядкового типу',
          'email.email' => 'Тут повинен бути електроний адрес',
          'email.unique' => 'Така електрона адреса вже існує',
          'role.required' => 'Це поле необхідно заповнити',
          'role.integer' => 'Це поле повинне бути числового типу',
        ];
    }
}
