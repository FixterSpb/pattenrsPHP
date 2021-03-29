<?php


namespace app\factory\dbFactory;
use app\factory\queryBuilder\QueryBuilder;
use app\factory\queryBuilder\OracleQueryBuilder;

class OracleFactory extends DBFactory
{

    protected function getDSNString(): string
    {
        return sprintf("%s:host=%s;dbname=%s",
            $this->dbConfig["driver"],
            $this->dbConfig["host"],
            $this->dbConfig["database"]
        );
    }

    public function getQueryBuilder(): QueryBuilder
    {
        return new \OracleQueryBuilder();
    }
}