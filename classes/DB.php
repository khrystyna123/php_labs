<?php

include_once 'Dbconfig.php';

class DB extends Dbconfig {

    protected $connection;

    protected $tblname;

    public function __construct() {
        try {
            $this->connection = new PDO($this->dsn, $this->username, $this->password);
        } catch (PDOException $e) {
            echo 'Failed to connect to MySQL - ' . $e->getMessage();
        }
    }

    public function insert($data) {
        $stmt = $this->connection->prepare(
            "INSERT IGNORE INTO ".$this->tblname." (".implode(', ', array_keys($data)).")
                      VALUES (:".implode(', :', array_keys($data)).")");
        $stmt->execute($data);
    }

    public function findBy($key, $value) {
        $stmt = $this->connection->prepare(
            "SELECT * FROM " . $this->tblname . " 
                        WHERE " . $key . " = " . $value . " ");
        $stmt->execute();

        return $stmt;
    }

    public function getIdBy($key, $value) {
        $stmt = $this->connection->prepare(
            "SELECT id FROM " . $this->tblname . " 
                        WHERE " . $key . " = " . $value . " ");
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['id'];
    }

    public function getAll() {
        $stmt = $this->connection->prepare(
            "SELECT * FROM " . $this->tblname . " ");
        $stmt->execute();

        return $stmt;
    }

    public function lastId() {
        return $this->connection->lastInsertId();
    }

    public function __destruct()
    {
        $this->connection = null;
    }


}