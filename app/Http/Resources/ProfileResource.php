<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                 => $this->id,
            'bio'                => $this->bio,
            'age'                => $this->age,
            'created_at'         => $this->created_at ? Carbon::parse($this->created_at)->format('d-m-Y H:i:s') : null,
            'updated_at'         => $this->updated_at ? Carbon::parse($this->updated_at)->format('d-m-Y H:i:s') : null,
            'user'               => new UserResource($this->whenLoaded('user')),
        ];
    }
}