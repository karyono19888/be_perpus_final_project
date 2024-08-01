<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'                 => $this->id,
            'title'              => $this->title,
            'summary'            => $this->summary,
            'image'              => $this->image,
            'stock'              => $this->stock,
            'created_at'         => $this->created_at ? Carbon::parse($this->created_at)->format('d-m-Y H:i:s') : null,
            'updated_at'         => $this->updated_at ? Carbon::parse($this->updated_at)->format('d-m-Y H:i:s') : null,
            'category'           => new RoleResource($this->whenLoaded('category')),
            'list_barrows'       => BorrowResource::collection($this->whenLoaded('borrow')),
        ];
    }
}