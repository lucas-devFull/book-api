<?php

// app/Http/Resources/AuthorResource.php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
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
