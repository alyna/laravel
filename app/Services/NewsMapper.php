<?php
namespace App\Services;

use Carbon\Carbon;

class NewsMapper
{
    /**
     * @param array $data
     * @return array
     */
    public function map(array $data): array
    {
        return [
            'title' => $data['abstract'] ?? null,
            'link' => $data['web_url'] ?? null,
            'snippet' => $data['snippet'] ?? null,
            'source' => $data['source'] ?? null,
            'document_type' => $data['document_type'] ?? null,
            'author' => $this->getAuthor($data),
            'short' => $data['lead_paragraph'] ?? null,
            'category' => $data['section_name'] ?? null,
            'subcategory' => $data['subsection_name'] ?? null,
            'published_at' => isset($data['pub_date']) ? Carbon::parse($data['pub_date'])->format('Y-m-d H:i:s') : null
        ];
    }

    /**
     * @param array $data
     * @return string|null
     */
    private function getAuthor(array $data): ?string
    {
        if (!isset($data['byline']['person'])
            || !is_array($data['byline']['person'])
            || count($data['byline']['person']) === 0
        ) {
            return null;
        }

        $author = $data['byline']['person'][0];
        $name = $author['firstname'] ?? '';
        if ($middleName = $author['middlename'] ?? null) {
            $name .= ' ' . $middleName;
        }
        if ($lastName = $author['lastname'] ?? null) {
            $name .= ' ' . $lastName;
        }

        return $name;
    }
}
