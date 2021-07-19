<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreUser
 * @package App\Http\Requests\Auth
 * @property string name
 * @property string email
 * @property string password
 * @property string device_name
 */
class StoreUser extends FormRequest
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
        return [
            'name' => 'required|string|min:3|max:100',
            'password' => 'required|min:4|max:16',
            'email' => 'required|email:filter|max:255',
            'device_name' => 'required|string|max:200'
        ];
    }
}
