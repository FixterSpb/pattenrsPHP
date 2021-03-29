<?php


namespace app\factory\dbFactory;
use app\factory\queryBuilder\PostgreSQLQueryBuilder;
use app\factory\queryBuilder\QueryBuilder;

class PostgreSQLFactory extends DBFactory
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
        return new PostgreSQLQueryBuilder();
    }
}