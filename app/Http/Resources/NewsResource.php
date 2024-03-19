<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $title
 * @property string $short
 * @property string $source
 * @property string $category
 * @property string $subcategory
 * @property string $author
 * @property string $link
 */
class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'short' => $this->short,
            'source' => $this->source,
            'category' => $this->category,
            'subcategory' => $this->subcategory,
            'author' => $this->author,
            'link' => $this->link,
        ];
    }
}
