<?php

namespace app\engine;


class DBQuery
{
    private \PDO $connection;
    public function __construct(string $dsn, string $userName, string $password){
        $this->connection = new \PDO($dsn, $userName, $password);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return bool|\PDOStatement
     */

    private function query(string $sql, array $params){
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function execute(string $sql, array $params){
        return $this->query($sql, $params)->rowCount();
    }

    public function queryOne(string $sql, array $params){
        return $this->query($sql, $params)->fetch();
    }

    public function queryAll(string $sql, array $params){
        return $this->query($sql, $params)->fetchAll();
    }

    public function queryObject(string $sql, array $params, $class){
        $stmt = $this->query($sql, $params);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        return $stmt->fetch();
    }
}