<?php
namespace Rahisi\RahisiDb;
use \PDO;
use \PDOException;
class connect {
    protected function db(){
        try {
            $conn = new PDO("mysql:host=".$_ENV['SEVER_NAME'].";dbname=".$_ENV['DB_NAME'],$_ENV['DB_USER_NAME'],$_ENV['PASSWORD']);
            // $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::EERMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            echo "failed: ".$e->getMessage();
            die;
        }
    }
}