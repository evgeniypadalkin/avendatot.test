<?php

namespace Core;


class Router {

    private static $routers = [];


    public static function get($url, $call)
    {
        static::addRouter('GET', $url, $call);
    }

    public static function post($url, $call)
    {
        static::addRouter('POST', $url, $call);
    }

    private static function addRouter(string $method, $url, $call)
    {

        $call_arr = explode("@", $call);

        if(isset($call_arr[0])) {
            $controller = $call_arr[0];
        }

        if(isset($call_arr[1])) {
            $function = $call_arr[1];
        }

        self::$routers[$method][$url] = [
             'controller' => $controller,
             'function' => $function
        ];
    }

    public function startRoute()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $parse_url = parse_url($_SERVER['REQUEST_URI']);
        $path = trim($parse_url['path'], '/');

        if(!$path) {
            $path = '/';
        }

        $request = new Request($method);

        if($method == 'GET') {
            $request->setParams($_GET);
        }

        if($method == 'POST') {
            $request->setParams($_POST);
        }

        if(isset(self::$routers[$method][$path])) {


            $controller_file = self::$routers[$method][$path]['controller'].'.php';
            $controller_path = dirname(__DIR__) . "/app/controllers/".$controller_file;

            if(file_exists($controller_path))
            {
                $controller = 'App\Controllers\\'.self::$routers[$method][$path]['controller'];
                $function = self::$routers[$method][$path]['function'];

                $call = new $controller;
                $call->$function($request);
            }
            else
            {
                self::initNotFoundRout();
            }

        } else {
            self::initNotFoundRout();
        }

    }


    private function initNotFoundRout()
    {
        echo '404';
    }
}