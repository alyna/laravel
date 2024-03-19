<?php

namespace App\Models;


use Carbon\Carbon;

class NewsRepository implements NewsRepositoryInterface
{
    /**
     * @param string $publishedDate
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getByPublishedDate(string $publishedDate)
    {
        $from = Carbon::parse($publishedDate)->setTime(0, 0, 0);
        $to = Carbon::parse($publishedDate)->setTime(23, 59, 59);
        return News::query()
            ->whereBetween('published_at', [
                $from->format('Y-m-d H:i:s'),
                $to->format('Y-m-d H:i:s')
            ])->get();
    }
}
