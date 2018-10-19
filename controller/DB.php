<?php
namespace System\DB;

use \PDO as PDO;

class Database
{

    public $pdo;
    public $stmt;


    public function con_pdo()
    {
        try {
            $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("SET NAMES 'utf8'");
            $this->pdo->exec("SET sql_mode = ''");

            return $this->pdo;
        } catch (Exception $e) {
            die('Cannot connect to DB');
        }
    }

    public function initialize()
    {
        $this->con_pdo();
    }

}