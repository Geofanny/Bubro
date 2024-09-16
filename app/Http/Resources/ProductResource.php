<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
    	// DEFAULT AKAN MENGIKUTI PARSING DATA DI CONTROLLER
        // return parent::toArray($request);

    	return [
    		'id' => $this->id,
    		'name' => $this->name,
            'category_id' => $this->category_id,
            'nama_kategori' => $this->category->name,
            'stock' => $this->stock,
            'image' => $this->image
        ];
    }
}
