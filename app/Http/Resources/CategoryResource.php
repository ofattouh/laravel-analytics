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
        // call: `/api/categories` and others.By default,Resource:`CategoryResource` doesn't transform fields
        return [
            'id' => $this->id,
            'name' => $this->name,
            // Show field:`description` only for route: `api/categories*` using conditional attribute `when`
            // Show description with limit only for:`api/categories*,and for single category,show full-length
            'description' => $this->when($request->is('api/categories*'), function () use ($request) {
                if ($request->is('api/categories')) {
                    return str($this->description)->limit(20);
                };

                return $this->description;
            }),
        ];
    }
}


/*
    Since we created API endpoint:`/api/categories`, we can create different Vue Composable:categories to get
    DB categories which is similar to other Vue Composable:posts to get DB posts

    Use resource class:`CategoryResource` for controller:`CategoryController' to return only needed fields

    API Resources: Different Fields for Endpoints:
    Using resource objects,we can have another API route with endpoint:`/lists/categories`, which doesn't
    show field:`description` and `description` must only be shown for routes with endpoint:`/api/categories*`

    Instead of using closure:`when` to show fields conditionally as done above, better to create different
    API Resources for every method. For example:create Resource:`CategoryShowResource` for single category and
    add description without limits. Then, for showing list of categories,create Resource:`CategoryIndexResource`
    where field description length will be limited or not even shown

    It is better to name Resources according to their respective Controller methods and if application has
    many Resources, they can be moved to separate directories for better maintenance

    'description' => $this->description,


*/
