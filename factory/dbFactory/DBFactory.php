<?php
namespace app\factory\dbFactory;

use app\engine\DBQuery;
use app\factory\queryBuilder\QueryBuilder;

abstract class DBFactory
{
    protected array $dbConfig;
    protected DBQuery $query;

    public function __construct(array $dbConfig)
    {
        $this->dbConfig = $dbConfig;
        $this->query = new DBQuery($this->getDSNString(), $dbConfig['login'], $dbConfig['password']);
    }

    public function getDBQuery():DBQuery{
        return $this->query;
    }

    protected abstract function getDSNString(): string;
    public abstract function getQueryBuilder():QueryBuilder;

/* Вместо этого реализовал data mapper
    abstract public function getDBRecord(): DBRecord;
*/
}