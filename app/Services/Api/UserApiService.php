<?php

namespace App\Services\Api;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserAdditionally;
use App\Services\TinifyService;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UserApiService
{
    private TinifyService $tinifyService;

    public function __construct(TinifyService $tinifyService)
    {
        $this->tinifyService = $tinifyService;
    }

    public function responseAll(array $data): JsonResponse
    {
        $users = User::query()->paginate($data['count'] ?? 5);

        if ($users->isNotEmpty()) {
            return response()->json([
                'success' => true,
                'page' => $users->currentPage(),
                "total_pages" => $users->lastPage(),
                "total_users" => $users->total(),
                "count" => $users->count(),
                "links" => [
                    "next_url" => $users->nextPageUrl(),
                    "prev_url" => $users->previousPageUrl(),
                ],
                "users" => UserResource::collection($users->items()),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Users not found',
        ], 404);
    }

    public function responseOne(array $data): JsonResponse
    {
        $user = User::query()->find($data['id']);

        if (!empty($user)) {
            return response()->json([
                'success' => true,
                "user" => UserResource::make($user),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'User not found',
        ], 404);
    }

    public function register(array $data): JsonResponse
    {
        $fillDataAdditionally = Arr::only($data, ['phone']);
        $fillData = Arr::only($data, ['name', 'email', 'phone', 'position_id', 'password']);

        try {
            $user = DB::transaction(function () use ($fillDataAdditionally, $fillData) {
                $userAdditionally = UserAdditionally::query()->create($fillDataAdditionally);
                $fillData['additionally_id'] = $userAdditionally->id;
                return User::query()->create($fillData);
            });

            $userAdditionallyID = (int) data_get($user, 'additionally.id');

            if ($userAdditionallyID > 0 && !empty($data['photo'])) {
                $this->tinifyService->upload($data['photo'], $userAdditionallyID);
            }

            return response()->json([
                'success' => true,
                'user_id' => $user->id,
                'message' => 'New user successfully registered',
            ]);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                $message = 'User with this phone or email already exist';
            } else {
                $message = $e->getMessage();
            }

            return response()->json([
                'success' => false,
                'message' => $message,
            ], 409);
        }
    }
}
