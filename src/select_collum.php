<?php

namespace Rahisi\RahisiDb;


use \PDO;

class select_collum extends connect

{

    public $collum;
    public $table;

    public function __construct($collums,$table)
    {
        $this->table = $table;
        if ($collums === "*") {
            $this->collum = $collums;
        } else {
            $strs = explode(",", $collums);
            $collumFormated = "";
            $x = 0;
            $commer = "";
            foreach ($strs as $collum) {
                if ($x > 0) {
                    $commer = ",";
                }
                $collumFormated .= "$commer $collum";
                $x++;
            }
            $this->collum = $collumFormated;
        }
    }

    public function all()
    {
        $collums = $this->collum;
        $query = new select("select $collums from $this->table", []);
        return $query;
    }

    public function where($condition)
    {
        $collums = $this->collum;
        $conditions = "";
        $bindCond = [];
        if (is_array($condition)) {
            $x = 0;
            $commer = "";
            foreach ($condition as $key => $value) {
                if ($x > 0) {
                    $commer = ",";
                }
                $conditions .= "$commer `$key` = ?";
                $bindCond[$x] = $value;
                $x++;
            }
        } else {
            $conditions = $condition;
        }
        $query = new select("SELECT $collums from $this->table WHERE $conditions", $bindCond);
        return $query;
    }

    public function selectCollum(string $collums = '*')
    {
        if ($collums === "*") {
            $this->collum = $collums;
        } else {
            $strs = explode(",", $collums);
            $collumFormated = "";
            $x = 0;
            $commer = "";
            foreach ($strs as $collum) {
                if ($x > 0) {
                    $commer = ",";
                }
                $collumFormated .= "$commer `$collum`";
                $x++;
            }
            $this->collum = $collumFormated;
        }
        return $this->collum;
    }


    public function execute($query, $bind)
    {
        //    $db = new connect;
        $prepare = $this->db()->prepare($query);
        $exc = $prepare->execute($bind);
        return $exc;
    }

    public function runQuery(&$obj)
    {
        $data = [];
        $x = 0;
        while ($a = $obj->fetch(PDO::FETCH_ASSOC)) {
            $data[$x] = $a;
            $x++;
        }
        return $data;
    }

    public function runQueryReturnValue(&$obj, $collum)
    {
        $data = [];
        $x = 0;
        while ($a = $obj->fetch(PDO::FETCH_ASSOC)) {
            $data[$x] = $a[$collum];
            $x++;
        }
        return $data;
    }

    public function lastId($table)
    {
        $sql = "SELECT `id` FROM `$table` WHERE id = (SELECT MAX(id) FROM `$table`) ";
        $stmt = $this->db()->query($sql);
        $data = $stmt->fetch();
        return  $data['id'];
    }
}
