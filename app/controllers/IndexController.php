<?php
/**
 * Created by PhpStorm.
 * User: evgen
 * Date: 05.01.2019
 * Time: 20:53
 */

namespace App\Controllers;


use Core\Request;

class IndexController
{
    public function __construct()
    {

    }

    public function index(Request $request) {
        echo '<a href="/news">Новости</a>';
    }
}