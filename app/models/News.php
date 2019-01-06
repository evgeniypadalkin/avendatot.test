<?php
/**
 * Created by PhpStorm.
 * User: evgen
 * Date: 06.01.2019
 * Time: 11:02
 */

namespace App\Models;

use Core\DB;
use PDO;

class News extends DB
{

    public function selectNews($start, $limit) {
        $stm = self::$dbConnection->prepare('SELECT id, title, text FROM news LIMIT :start, :limit');
        $stm->bindValue('start', $start, PDO::PARAM_INT);
        $stm->bindValue('limit', $limit, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchAll();
    }

}