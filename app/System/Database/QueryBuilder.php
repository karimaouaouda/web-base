<?php

namespace App\System\Database;

use PDO;

class QueryBuilder
{
    protected $pdo;
    protected $table = "users";
    protected $select = '*';
    protected $joins = [];
    protected $where = [];
    protected $orWhere = [];
    protected $groupBy = '';
    protected $having = [];
    protected $orderBy = '';
    protected $limit = '';
    protected $offset = '';

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function table(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    public function select(array $columns): self
    {
        $this->select = implode(', ', $columns);
        return $this;
    }

    public function join(string $table, string $column1, string $operator, string $column2): self
    {
        $this->joins[] = [
            'type' => 'INNER',
            'table' => $table,
            'column1' => $column1,
            'operator' => $operator,
            'column2' => $column2
        ];
        return $this;
    }

    public function leftJoin(string $table, string $column1, string $operator, string $column2): self
    {
        $this->joins[] = [
            'type' => 'LEFT',
            'table' => $table,
            'column1' => $column1,
            'operator' => $operator,
            'column2' => $column2
        ];
        return $this;
    }

    public function rightJoin(string $table, string $column1, string $operator, string $column2): self
    {
        $this->joins[] = [
            'type' => 'RIGHT',
            'table' => $table,
            'column1' => $column1,
            'operator' => $operator,
            'column2' => $column2
        ];
        return $this;
    }

    public function where(string $column, string $operator, $value): self
    {
        $this->where[] = [
            'type' => 'AND',
            'column' => $column,
            'operator' => $operator,
            'value' => $value
        ];
        return $this;
    }

    public function orWhere(string $column, string $operator, $value): self
    {
        $this->orWhere[] = [
            'type' => 'OR',
            'column' => $column,
            'operator' => $operator,
            'value' => $value
        ];
        return $this;
    }

    public function groupBy(string $column): self
    {
        $this->groupBy = $column;
        return $this;
    }

    public function having(string $column, string $operator, $value): self
    {
        $this->having = [
            'column' => $column,
            'operator' => $operator,
            'value' => $value
        ];
        return $this;
    }

    public function orderBy(string $column, string $direction): self
    {
        $this->orderBy = [
            'column' => $column,
            'direction' => $direction
        ];
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset(int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    public function getQuery(){
        $query = "SELECT {$this->select} FROM {$this->table}";

        foreach ($this->joins as $join) {
            $query .= " {$join['type']} JOIN {$join['table']} ON {$join['column1']} {$join['operator']} {$join['column2']}";
        }

        $query .= $this->buildWhereClause();

        if (!empty($this->groupBy)) {
            $query .= " GROUP BY {$this->groupBy}";
        }

        if (!empty($this->having)) {
            $query .= " HAVING {$this->having['column']} {$this->having['operator']} '{$this->having['value']}'";
        }

        if (!empty($this->orderBy)) {
            $query .= " ORDER BY {$this->orderBy['column']} {$this->orderBy['direction']}";
        }

        if (!empty($this->limit)) {
            $query .= " LIMIT {$this->limit}";
        }

        if (!empty($this->offset)) {
            $query .= " OFFSET {$this->offset}";
        }

        return $query;
    }
    public function get(): array
    {
        $query = "SELECT {$this->select} FROM {$this->table}";

        foreach ($this->joins as $join) {
            $query .= " {$join['type']} JOIN {$join['table']} ON {$join['column1']} {$join['operator']} {$join['column2']}";
        }

        $query .= $this->buildWhereClause();

        if (!empty($this->groupBy)) {
            $query .= " GROUP BY {$this->groupBy}";
        }

        if (!empty($this->having)) {
            $query .= " HAVING {$this->having['column']} {$this->having['operator']} '{$this->having['value']}'";
        }

        if (!empty($this->orderBy)) {
            $query .= " ORDER BY {$this->orderBy['column']} {$this->orderBy['direction']}";
        }

        if (!empty($this->limit)) {
            $query .= " LIMIT {$this->limit}";
        }

        if (!empty($this->offset)) {
            $query .= " OFFSET {$this->offset}";
        }

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($this->buildParams());

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function buildWhereClause(): string
    {
        $whereClause = '';

        if (!empty($this->where)) {
            $whereClause .= " WHERE ";
            foreach ($this->where as $index => $condition) {
                $whereClause .= "{$condition['column']} {$condition['operator']} ?";
                if ($index < count($this->where) - 1) {
                    $whereClause .= " {$condition['type']} ";
                }
            }
        }

        if (!empty($this->orWhere)) {
            if (!empty($whereClause)) {
                $whereClause .= " OR ";
            } else {
                $whereClause .= " WHERE ";
            }

            foreach ($this->orWhere as $index => $condition) {
                $whereClause .= "{$condition['column']} {$condition['operator']} ?";
                if ($index < count($this->orWhere) - 1) {
                    $whereClause .= " {$condition['type']} ";
                }
            }
        }

        return $whereClause;
    }

    protected function buildParams(): array
    {
        $params = [];

        foreach ($this->where as $condition) {
            $params[] = $condition['value'];
        }

        foreach ($this->orWhere as $condition) {
            $params[] = $condition['value'];
        }

        return $params;
    }
}