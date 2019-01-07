<?php
/**
 * Created by PhpStorm.
 * User: evgen
 * Date: 07.01.2019
 * Time: 17:17
 */

namespace Core;


class Response
{
    public static function json($arr){
        echo json_encode($arr);
    }
}