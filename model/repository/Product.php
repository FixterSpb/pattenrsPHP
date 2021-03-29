<?php


namespace app\model\repository;

use app\factory\dbFactory\DBFactory;
use app\model\entity\Entity;

class Product extends Repository
{

    protected function getTableName(): string
    {
        return 'product';
    }

    /**
     * @return Entity|string
     */
    protected function getEntityClass()
    {
        return \app\model\entity\Product::class;
    }
}