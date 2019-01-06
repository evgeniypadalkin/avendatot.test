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

    public function selectNewsById($id) {
        $stm = self::$dbConnection->prepare('SELECT id, title, text FROM news WHERE id = :id');
        $stm->execute(['id'=>$id]);
        return $stm->fetch();
    }

    public function editNews($data) {
        $stm = self::$dbConnection->prepare('UPDATE news SET title = :title, text = :text WHERE id = :id');
        $stm->execute(['id'=>$data['id'], 'title'=>$data['title'], 'text'=>$data['text']]);
    }

}