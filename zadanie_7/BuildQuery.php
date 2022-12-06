<?php

namespace zadanie_7;

use zadanie_7\DB;

class BuildQuery extends DB
{
    private $arrayQuery;
    private $class;

    public function __construct($table, $class)
    {
        $this->arrayQuery = [
            'SELECT' => '*',
            'FROM' => $table,
            'JOIN' => null,
            'WHERE' => null,
            'LIMIT' => 0,
            'OFFSET' => 0,
            'GROUP BY' => null,
            'ORDER BY' => null
        ];

        $this->class = $class;
    }

    public function select($data)
    {
        $select = '*';

        if (is_string($data)) {
            $select = $data;
        } else if (is_array($data) and count($data) > 0) {
            $select = implode(', ', $data);
        }

        $this->arrayQuery['SELECT'] = $select;

        return $this;
    }

    public function where($data)
    {
        $where = null;

        if (is_string($data)) {
            $where = $data;
        } else if (is_array($data)) {
            foreach ($data as $key => &$value) {
                $subWhere = $key . ' IN ';
                if (!is_array($value)) {
                    $value = $subWhere . '(\'' . $value .'\')';
                } else if (is_array($value)) {
                    foreach($value as &$val) {
                        $val = "'$val'";
                    }
                    $value = $subWhere . '(' . implode(', ', $value) .')';
                }
            }
            $where = implode(' AND ', $data);
        }

        $this->arrayQuery['WHERE'] = $where;

        return $this;
    }

    public function limit(int $limit)
    {
        $this->arrayQuery['LIMIT'] = $limit;

        return $this;
    }

    public function offset(int $offset)
    {
        $this->arrayQuery['OFFSET'] = $offset;

        return $this;
    }

    public function orderBy($data)
    {
        $orderBy = null;

        if (is_string($data)) {
            $orderBy = $data;
        } else if (is_array($data)) {
            foreach ($data as $key => &$value) {
                $value = $key . ' ' . $value;
            }
            $orderBy = implode(', ', $data);
        }

        $this->arrayQuery['ORDER BY'] = $orderBy;

        return $this;
    }

    public function groupBy($data) {
        $groupBy = '';

        if (is_string($data)) {
            $groupBy = $data;
        } else if (is_array($data) and count($data) > 0) {
            $groupBy = implode(', ', $data);
        }

        $this->arrayQuery['GROUP BY'] = $groupBy;

        return $this;
    }

    public function join(array $data)
    {
        $join = '';
        foreach ($data as $value) {
            $join .= " " . mb_strtoupper($value[0]) . " JOIN ". $value[1] ." ON " . $value[2];
        }
        $this->arrayQuery['JOIN'] = $join;
    
        return $this;
    }

    public function getQuery()
    {
        $sql = '';

        foreach ($this->arrayQuery as $key => $value) {
            if ($value) {
                if ($key == 'JOIN') {
                    $sql .= " $value";
                } else {
                    $sql .= " $key $value";
                }
                
            }
        }

        return $sql;
    }

    public function getAll()
    {
        $query = $this->getQuery();

        $db = (new DB)->pdo;
        // $data = ($db->query($query))->fetchAll(\PDO::FETCH_CLASS, $this->class);
        $data = ($db->query($query))->fetchAll();

        return $data;
    }

    public function getOne()
    {
        $query = $this->getQuery();

        $db = (new DB)->pdo;

        $data = ($db->query($query))->fetch();

        return $data;
    }

}