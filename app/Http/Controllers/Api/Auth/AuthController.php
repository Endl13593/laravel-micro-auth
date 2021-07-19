<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthUser;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @throws ValidationException
     */
    public function auth(AuthUser $request): UserResource
    {
        $user = $this->model->where('email', $request->email)->firstOrFail();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;

        return (new UserResource($user))->additional(['token' => $token]);
    }

    public function logout(Request $request): array
    {
        $request->user()->tokens()->delete();

        return ['logout' => 'success'];
    }

    public function me(Request $request): UserResource
    {
        $user = $request->user();

        return new UserResource($user);
    }
}
