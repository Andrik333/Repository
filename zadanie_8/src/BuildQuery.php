<?php

namespace src;

use src\DB;

class BuildQuery extends DB
{
    private $arrayQuery;
    private $class;
    private $join;

    public function __construct($table, $class)
    {
        parent::__construct();

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

        $data = $this->query($query)->fetchAll(\PDO::FETCH_CLASS, $this->class);

        $this->getJoinData($data);

        return $data;
    }

    public function getOne()
    {
        $query = $this->getQuery();

        $data = $this->query($query)->fetchObject($this->class);

        $this->getJoinData($data);

        return $data;
    }

    private function getJoinData(&$data) {
        if (!$this->join or !$data) {
            return $data;
        }

        foreach ($this->join as $join) {
            $linkKey = array_key_first($join['link']);
            $linkId = $join['link'][$linkKey];
            if (is_array($data)) {
                $linkData = array_column($data, $linkId);
            } else {
                $linkData = [$data->$linkId];
            }
            $class = $join['class'];
            $joinWith = isset($join['joinWith']) ? $join['joinWith'] : null;
            $order = isset($join['order']) ? $join['order'] : null;
            $subData = $class::find()->joinWith($joinWith)->where([$linkKey => $linkData])->orderBy($order)->getAll();

            if ($join['type'] == 'getAll') {
                $data->{$join['join']} = [];
            }

            if (is_array($data)) {
                foreach ($data as &$row) {
                    foreach ($subData as $subRow) {
                        if ($row->{$linkId} == $subRow->$linkKey) {
                            if ($join['type'] == 'getAll') {
                                $row->{$join['join']}[] = $subRow;
                            } else {
                                $row->{$join['join']} = $subRow;
                            }
                        }
                    }
                }
            } else {
                foreach($subData as $subRow) {
                    if ($data->{$linkId} == $subRow->$linkKey) {
                        if ($join['type'] == 'getAll') {
                            $data->{$join['join']}[] = $subRow;
                        } else {
                            $data->{$join['join']} = $subRow;
                        }
                    }
                }
            }
        }
    }

    public function joinWith(array $link = null)
    {
        if ($link) {
            $model = $this->class;
            foreach ($link as $value) {
                $method = 'get' . ucfirst($value);
                $data = (new $model)->$method();
                $data['join'] = $value;
                $this->join[] = $data;
            }
        }

        return $this;
    }

    // public function joinWith(array $link)
    // {
    //     var_dump($this->class);
    //     foreach ($link as $key => $value)
    //     {
    //         if (is_int($key)) {
    //             $name = $value;
    //             $callback = null
    //         }


    //     }
    //     $methods = 'get' . ucfirst();

    //     return $this;
    // }
}