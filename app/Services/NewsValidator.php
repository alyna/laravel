<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class NewsValidator
{
    /**
     * @param array $data
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validate(array $data): array
    {
        $validator = Validator::make($data, [
            'title' => 'required|string',
            'link' => 'required|url',
            'snippet' => 'required|string',
            'author' => 'required|string',
            'document_type' => 'required|string',
            'short' => 'required|string',
            'source' => 'required|string',
            'category' => 'string|nullable',
            'subcategory' => 'string|nullable',
            'published_at' => 'required|date_format:Y-m-d H:i:s',
        ]);

        return $validator->validate();
    }
}
