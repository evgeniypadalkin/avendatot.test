<?php

namespace Core;


class DB
{
    protected static $dbConnection;

    public static function setDbConnection(\PDO $dbConnection)
    {
        self::$dbConnection = $dbConnection;
    }
}