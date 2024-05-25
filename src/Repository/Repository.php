<?php

namespace OSJ\Repository;

use OSJ\Connection\PDOConnection;

abstract class Repository
{
    protected $conn;

    public function __construct()
    {
        $this->conn = new PDOConnection;
        $this->conn = $this->conn->connect();
    }

    public function beginTransaction()
    {
        $this->conn->beginTransaction();
    }

    public function commit()
    {
        $this->conn->commit();
    }

    public function rollback()
    {
        $this->conn->rollback();
    }
}
