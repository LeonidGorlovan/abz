<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\PositionApiService;
use Illuminate\Http\JsonResponse;

class PositionController extends Controller
{
    private PositionApiService $positionService;

    public function __construct(PositionApiService $positionService)
    {
        $this->positionService = $positionService;
    }

    public function __invoke(): JsonResponse
    {
        return $this->positionService->responseAll();
    }
}
