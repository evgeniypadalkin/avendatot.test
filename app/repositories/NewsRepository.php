<?php
/**
 * Created by PhpStorm.
 * User: evgen
 * Date: 06.01.2019
 * Time: 11:13
 */

namespace App\Repositories;


use App\Models\News;

class NewsRepository
{
    private $news;

    public function __construct(News $news_model)
    {
        $this->news = $news_model;
    }

    public function getNews($start = 0, $limit = 10) {
        $news_rows = $this->news->selectNews($start, $limit);
        return $news_rows;
    }
}