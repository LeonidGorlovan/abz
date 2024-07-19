<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRegisterRequest;
use App\Http\Requests\Api\UserRequest;
use App\Http\Requests\Api\UsersRequest;
use App\Services\Api\UserApiService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private UserApiService $userServices;

    public function __construct(UserApiService $userServices)
    {
        $this->userServices = $userServices;
    }

    public function all(UsersRequest $request): JsonResponse
    {
        return $this->userServices->responseAll($request->validated());
    }

    public function one(UserRequest $request): JsonResponse
    {
        return $this->userServices->responseOne($request->validated());
    }

    public function register(UserRegisterRequest $request): JsonResponse
    {
        return $this->userServices->register($request->validated());
    }
}
