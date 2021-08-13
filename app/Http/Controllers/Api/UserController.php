<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
        $this->middleware('can:users');
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $users = $this->model->with('permissions')->paginate();

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateUser $request
     * @return UserResource
     */
    public function store(StoreUpdateUser $request): UserResource
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $user = $this->model->create($data);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $identify
     * @return UserResource
     */
    public function show(string $identify): UserResource
    {
        $user = $this->model->with('permissions')->where('uuid', $identify)->firstOrFail();

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateUser $request
     * @param string $identify
     * @return string[]
     */
    public function update(StoreUpdateUser $request, string $identify): array
    {
        $user = $this->model->where('uuid', $identify)->firstOrFail();

        $data = $request->validated();

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return ['updated' => 'success'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $identify
     * @return string[]
     */
    public function destroy(string $identify): array
    {
        $user = $this->model->where('uuid', $identify)->firstOrFail();

        $user->delete();

        return ['deleted' => 'success'];
    }
}
