<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class galleryResource extends JsonResource
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
    		'title' => $this->title,
    		'media_path' => $this->media_path,
    		'created_at' => $this->created_at->format('Y-m-d H:i'),
    	];
    }
}
