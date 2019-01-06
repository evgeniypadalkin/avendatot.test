<?php

namespace Core;

use Core\Router;
use PDO;

class Application
{

    public function run()
    {

        require dirname(__DIR__) . '/config/database.php';
        DB::setDbConnection(new PDO(db_connection.':host='.db_host.';dbname='.db_name, db_user, db_pass));

        require dirname(__DIR__) . '/routers/web.php';
        Router::startRoute();

    }

}
