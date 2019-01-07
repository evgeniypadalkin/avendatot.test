<?php

use Core\Router;

    Router::get('/', 'IndexController@index');
    Router::get('news', 'NewsController@index');

    Router::post('news', 'NewsController@page');
    Router::post('news/add', 'NewsController@add');
    Router::post('news/get', 'NewsController@get');
    Router::post('news/edit', 'NewsController@edit');
    Router::post('news/delete', 'NewsController@delete');