<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        // Transform `text`,`created_at`,`updated_at` fields to different format, add extra `data` wrapper field
        // for output of API call: `/api/posts`.By default, `PostResource` API resource doesn't transform fields
        return [
            'id' => $this->id,
            'title' => $this->title,
            'text' => substr($this->text, 0, 50). '...', // Get first 50 characters and append 3 dots
            'category_id' => $this->category_id,
            'created_at' => $this->created_at->toDateString(), // Transform to readable date format
            'updated_at' => $this->updated_at->toDateString(),
        ];
    }
}
