<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_admin' => $this->is_admin,
            'avatar' => $this->getImageUrl('preview'),
            'projects' => ProjectIndexResource::collection($this->whenLoaded('projects')),
            'reviews' => ReviewIndexResource::collection($this->whenLoaded('reviews')),
        ];
    }
}