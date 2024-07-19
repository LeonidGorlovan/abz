<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function getToken(AuthRequest $request): JsonResponse
    {
        $user = User::query()->where('email', $request->email)->first();

        if (!empty($user) && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('web');

            return response()->json([
                'success' => true,
                'token' => $token->plainTextToken,
            ]);
        }

        return response()->json([
            'success' => false,
        ]);
    }
}
