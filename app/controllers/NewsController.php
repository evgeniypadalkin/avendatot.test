<?php

namespace App\Controllers;

use App\Models\News;
use App\Repositories\NewsRepository;
use Core\Pagination;
use Core\Request;
use Core\Response;

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

        $total = $this->news_rep->total();

        $paginate = new Pagination($total, 1, '/news');
        $this->data['paginate'] = $paginate->render();
        $this->render();
    }

    public function add(Request $request) {

        if($request->validate(['title'=>'required', 'text'=>'required'])){
            $id = $this->news_rep->addNews($request);

            $total = $this->news_rep->total();
            $paginate = new Pagination($total, 1, '/news');
            Response::json(['id' => $id, 'paginate'=>$paginate->render()]);
        } else {
            Response::json(['error' =>$request->errors]);
        }

    }

    public function get(Request $request) {
        if(isset($request->param['id'])) {
            $item = $this->news_rep->getNewsById($request->param['id']);
            Response::json($item);
        } else {
            Response::json(['error' => 'Error id']);
        }
    }

    public function edit(Request $request) {

        if($request->validate(['id'=>'required', 'title'=>'required', 'text'=>'required'])){
            $this->news_rep->editNews($request);
            Response::json(['success' => 'Ok']);
        } else {
            Response::json(['error' =>$request->errors]);
        }

    }

    public function delete(Request $request) {
        if(isset($request->param['id'])) {
            $this->news_rep->deleteNews($request->param['id']);

            $total = $this->news_rep->total();
            $paginate = new Pagination($total, 1, '/news');
            Response::json(['paginate'=>$paginate->render()]);
        } else {
            Response::json(['error' => 'Error id']);
        }
    }

    public function page(Request $request) {

        if(isset($request->param['page']) && $request->param['limit']) {
            $start = ($request->param['page']-1)*$request->param['limit'];
            $limit = $request->param['limit'];
            $news = $this->news_rep->getNews($start, $limit);
            Response::json(['news' => $news]);
        } else {
            Response::json(['error' => 'Not page or limit']);
        }

    }
}
