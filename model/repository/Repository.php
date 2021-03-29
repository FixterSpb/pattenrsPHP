<?php


namespace app\model\repository;

use app\factory\dbFactory\DBFactory;
use app\model\entity\Entity;

abstract class Repository
{
    protected DBFactory $db;

    public function __construct(DBFactory $db){
        $this->db = $db;
    }

    /**
     * @param $id
     * @return Entity | bool
     *
     */
    public function getOne($id){
        $qb = $this->db->getQueryBuilder();
        $qb->select()
            ->from($this->getTableName())
            ->where(
                $qb->eq('id', $id)
            );
        return $this->db->getDBQuery()->queryObject($qb->getQueryString(), $qb->getParams(), $this->getEntityClass());
    }

    abstract protected function getTableName(): string;
    abstract protected function getEntityClass();
}