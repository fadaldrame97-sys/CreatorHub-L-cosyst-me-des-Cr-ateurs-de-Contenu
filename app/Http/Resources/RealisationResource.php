<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RealisationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'media_url'   => $this->media_url,
            'media_type'  => $this->media_type,
            'user'        => $this->whenLoaded('user'),
            'skills'      => $this->whenLoaded('skills'),
            'likes_count' => $this->likes_count,
            'saves_count' => $this->saves_count,
            'created_at'  => $this->created_at,
        ];
    }
}
