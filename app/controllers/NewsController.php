<?php

namespace App\Controllers;

use App\Models\News;
use App\Repositories\NewsRepository;
use Core\Request;

class NewsController extends MainController
{
    public $news_rep;

    public function __construct()
    {
        $this->news_rep = new NewsRepository(new News());
        $this->template = 'news.tpl';
    }

    public function index(Request $request) {
        $this->data['news'] = $this->news_rep->getNews();
        $this->render();
    }
}
