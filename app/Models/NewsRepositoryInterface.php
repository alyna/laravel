<?php

namespace App\Models;

interface NewsRepositoryInterface
{
    /**
     * @param string $publishedDate
     * @return mixed
     */
    public function getByPublishedDate(string $publishedDate);
}
