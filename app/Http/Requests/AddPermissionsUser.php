<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AddPermissionsUser
 * @package App\Http\Requests
 * @property string user
 * @property array permissions
 */
class AddPermissionsUser extends FormRequest
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
            'user' => 'required',
            'permissions' => 'required|array'
        ];
    }
}
