<?php

use Core\Router;

    Router::get('/', 'IndexController@index');
    Router::get('news', 'NewsController@index');

    Router::post('news/get', 'NewsController@get');
    Router::post('news/edit', 'NewsController@edit');