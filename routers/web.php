<?php

use Core\Router;

    Router::get('/', 'IndexController@index');
    Router::get('news', 'NewsController@index');