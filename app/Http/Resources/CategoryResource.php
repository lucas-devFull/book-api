<?php

// app/Http/Resources/CategoryResource.php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'books_count' => $this->books->count(),
        ];
    }
}
