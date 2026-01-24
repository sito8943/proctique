<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectShowResource extends JsonResource
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
            'content' => $this->content,
            'author' => new AuthorIndexResource($this->whenLoaded('author')),
            'image_url' => $this->getImageUrl('website'),
            'promo_url' => route('projects.show', ['project' => $this->id]),
            'reviews' => ReviewIndexResource::collection($this->whenLoaded('reviews')),
            'tags' => TagIndexResource::collection($this->whenLoaded('tags')),
        ];
    }
}
