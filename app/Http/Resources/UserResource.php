<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => data_get($this, 'additionally.phone'),
            'position' => data_get($this, 'position.title'),
            'position_id' => $this->position_id,
            'registration_timestamp' => Carbon::parse($this->created_at)->format('U'),
            'photo' => asset('storage/photo/' . data_get($this, 'additionally.photo')),
        ];
    }
}
