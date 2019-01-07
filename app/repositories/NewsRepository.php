<?php

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

    public function getNewsById($id) {
        $news_row = $this->news->selectNewsById($id);
        return $news_row;
    }

    public function addNews($request) {
        $data = [
            'title' => $request->param['title'],
            'text' => $request->param['text'],
        ];

        $id = $this->news->addNews($data);
        return $id;
    }

    public function editNews($request) {

        $data = [
            'id' => $request->param['id'],
            'title' => $request->param['title'],
            'text' => $request->param['text'],
        ];

        $this->news->editNews($data);
    }

    public function deleteNews($id) {
        $this->news->deleteNewsById($id);
    }

    public function total() {
        $total = $this->news->total();
        return $total['total'];
    }
}