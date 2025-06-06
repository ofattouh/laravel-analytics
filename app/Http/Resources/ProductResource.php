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
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => number_format($this->price / 100, 2),
            'category' => CategoryResource::make($this->whenLoaded('category')), // return only id,name from `CategoryResource`
            // 'category' => $this->category, // return ALL DB fields from Category
        ];
    }
}

/*

    Use Resources to hide or modify fields returned wrapped in `data`.Change the price field output format

    To call Resource inside another Resource and reuse `CategoryResource` in `ProductResource`,use conditional
    relationship `whenLoaded` to show `category` only when it is eager loaded and avoid N+1 query problem

*/
