<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        // Transform fields to different format if needed, add extra `data` wrapper field for output of API
        // call: `/api/categories`.By default, `CategoryResource` API resource doesn't transform fields
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}


/*
    Since we created API endpoint:`/api/categories`, we can create different Vue Composable:categories to get
    DB categories which is similar to other Vue Composable:posts to get DB posts

*/
