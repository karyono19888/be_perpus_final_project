<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BorrowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'load_date'         => $this->load_date,
            'borrow_date'       => $this->borrow_date,
            'created_at'        => $this->created_at ? Carbon::parse($this->created_at)->format('d-m-Y H:i:s') : null,
            'updated_at'        => $this->updated_at ? Carbon::parse($this->updated_at)->format('d-m-Y H:i:s') : null,
            'list_books'        => new BookResource($this->whenLoaded('book')),
            'user'              => new UserResource($this->whenLoaded('user')),
        ];
    }
}