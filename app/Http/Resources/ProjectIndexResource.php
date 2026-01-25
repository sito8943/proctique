<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ProjectIndexResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'leading' => $this->leading,
            'author' => new AuthorShowResource($this->whenLoaded('author')),
            'image_url' => $this->getImageUrl('preview'),
            'link' => route('api.projects.show', ['id' => $this->id]),/*
            //TODO CHECK THIS WITH NICO
            //Is asking for a parameters 'project'
            'promo_url' => route('projects.show', $this->slug), */
        ];
    }
}
