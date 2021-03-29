<?php


namespace app\factory\dbFactory;
use app\factory\queryBuilder\QueryBuilder;
use app\factory\queryBuilder\MySQLQueryBuilder;

class MySQLFactory extends DBFactory
{

    protected function getDSNString(): string
    {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->dbConfig["driver"],
            $this->dbConfig["host"],
            $this->dbConfig["database"],
            $this->dbConfig["charset"]
        );
    }

    public function getQueryBuilder(): QueryBuilder
    {
        return new MySQLQueryBuilder();
    }
}