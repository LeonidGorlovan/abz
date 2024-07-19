<?php

namespace App\Services\Api;

use App\Models\UserPosition;
use Illuminate\Http\JsonResponse;

class PositionApiService
{
    public function responseAll(): JsonResponse
    {
        $positions = UserPosition::all();

        return response()->json([
            'success' => true,
            'positions' => $positions
        ]);
    }
}
