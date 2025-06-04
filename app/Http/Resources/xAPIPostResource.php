<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

// Eloquent API Resource class
use App\Http\Resources\xAPIPostResource;

class xAPIPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        // var_dump($request);

        // return parent::toArray($request);

        // Transform `name`,`created_at`,`updated_at` fields to different format, add extra `data` wrapper field
        // for output of API call: `/api/xapiposts`.By default,Resource:`xAPIPostResource` doesn't transform fields
        return [
            'id'   => 9999,
            'name' => 'John Doe',
        ];

        /*
        return [
            'id' => $this->id,
            'title' => $this->title,
            'text' => substr($this->text, 0, 50). '...', // Get first 50 characters and append 3 dots
            'category_id' => $this->category_id,
            'category_name' => $this->category->name,
            'created_at' => $this->created_at->toDateString(), // Transform to readable date format
            'updated_at' => $this->updated_at->toDateString(),
        ];
        */
    }
}
