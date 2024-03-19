<?php

namespace App\Models;

/**
 * News repository interface
 */
interface NewsRepositoryInterface
{
    /**
     * @param string $publishedDate
     * @return mixed
     */
    public function getByPublishedDate(string $publishedDate);
}
