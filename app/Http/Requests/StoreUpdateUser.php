<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreUpdateUser
 * @package App\Http\Requests
 * @property string id
 * @property string name
 * @property string email
 * @property string password
 */
class StoreUpdateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $uuid = $this->user;

        $rules = [
            'name' => 'required|string|min:3|max:100',
            'password' => 'required|min:4|max:16',
            'email' => ['required', 'email:filter', 'max:255', "unique:users,email,{$uuid},uuid"]
        ];

        if ($this->method() == 'PUT') {
            $rules['password'] = 'nullable|min:4|max:16';
        }

        return $rules;
    }
}
