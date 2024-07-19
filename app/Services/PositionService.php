<?php

namespace App\Services;

use App\Models\UserPosition;
use Illuminate\Support\Collection;

class PositionService
{
    public function getForSelect(): Collection
    {
        return UserPosition::query()->pluck('title', 'id');
    }
}
