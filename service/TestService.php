<?php

namespace app\service;


use app\factory\dbFactory\DBFactory;
use app\model\repository\Product;

class TestService
{

    private DBFactory $db;

    public function __construct(){
        //Подключение к БД
        $this->connect();
    }

    private function connect(){
        //Конфигурация БД
        $dbConfig = include "../config/dbConfig.php";
        //Подключение
        $this->db = new $dbConfig["class"]($dbConfig);
    }

    /**
     * @param $id
     * @return \app\model\entity\Product | bool
     */

    public function getProduct($id){
        return (new \app\model\repository\Product($this->db))->getOne($id);
    }

    public function test(){
        $qb = $this->db->getQueryBuilder();
        $qb->select(['p.id', 'p.name', 'p.price'])
            ->from('product', 'p')
            ->where($qb->andX(
                $qb->notEq('p.name', 'Мышка'),
                $qb->orX(
                    $qb->low('p.id', 3),
                    $qb->upp('p.id', 1),
                )
            ))
            ->orderBy('p.id', 'DESC');
        return $qb->buildTest();
    }
}