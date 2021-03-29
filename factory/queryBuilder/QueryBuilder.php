<?php


namespace app\factory\queryBuilder;

/**
 * Конструктор SQL-запросов
 * Class QueryBuilder
 * @package app\factory\dbFactory
 */

abstract class QueryBuilder
{
    protected string $query = '';
    protected int $counter = 0;
    protected array $params = [];

    /**
     * @param string[] $fields
     * @return QueryBuilder
     */
    public function select(array $fields = ['*']): QueryBuilder{
        $this->query .= " SELECT " . implode(', ', $fields);
        return $this;
    }

    public function from(string $tableName, string $tableAlias = ''): QueryBuilder{
        $this->query .= " FROM $tableName";
        if ($tableAlias !== '') {$this->query .= "  $tableAlias";}
        return $this;
    }

    public function where(string $sqlWhere): QueryBuilder{
        $this->query .= " WHERE $sqlWhere";
        return $this;
    }

    /** Условие равенства
     * @param string $field
     * @param int | string $value
     * @return string
     */
    public function eq(string $field, $value){
        $this->counter++;
        $this->params["param$this->counter"] = $value;
        return "$field = :param$this->counter";
    }
    /** Условие неравенства
     * @param string $field
     * @param int | string $value
     * @return string
     */
    public function notEq(string $field, $value){
        $this->counter++;
        $this->params["param$this->counter"] = $value;
        return "$field <> :param$this->counter";
    }

    /** Условие больше
     * @param string $field
     * @param int $value
     * @return string
     */
    public function upp(string $field, int $value){
        $this->counter++;
        $this->params["param$this->counter"] = $value;
        return "$field > :param$this->counter";
    }

    /** Условие меньше
     * @param string $field
     * @param int $value
     * @return string
     */
    public function low(string $field, int $value){
        $this->counter++;
        $this->params["param$this->counter"] = $value;
        return "$field < :param$this->counter";
    }

    public function andX(string ...$conditions):string{
        return "(" . implode(" AND ", $conditions) . ")";
    }

    public function orX(string ...$conditions):string{
        return "(" . implode(" OR ", $conditions) . ")";
    }

    public function limit(int $limit): QueryBuilder{
        $this->counter++;
        $this->params["param$this->counter"] = $limit;
        $this->query .= " LIMIT :param$this->counter";
        return $this;
    }

    public function offset(int $offset): QueryBuilder{
        $this->counter++;
        $this->params["param$this->counter"] = $offset;
        $this->query .= " OFFSET :param$this->counter";
        return $this;
    }

    /**
     * @param string $field
     * @param string $order
     * @return $this
     */

    public function orderBy(string $field, string $order = 'ASC'): QueryBuilder{
        $this->query .= " ORDER BY $field $order";
        return $this;
    }

    public function getQueryString(): string{
        return $this->query;
    }

    public function getParams(): array{
        return $this->params;
    }

    /** Тестовый метод исключительно для того, чтобы получить сформированную строку запроса
     *  и протестировать в соответствующей БД.
     *  Результат выполнения данного метода не защищен от sql-инъекций
     *
     * @return string
     */
    public function build(): string {
        $sql = $this->query;
        foreach ($this->params as $key=>$value){

            $sql = str_replace(":$key", "'$value'", $sql);
            echo " $key $value $sql", PHP_EOL;
        }
        return trim($sql) . ";";
    }
}