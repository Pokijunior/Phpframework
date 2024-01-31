<?php

namespace Lovro\Phpframework;

use PDO;

class Connection {
    private static $instance = null;
    private $connection;
    private $statement;

    private function __construct() {
        $this->connection = new PDO('mysql:host=localhost;dbname=factory', 'root', '', [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Connection();
        }

        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
    
    public function select($query, $values) {
        $this->statement = $this->connection->prepare($query);
        foreach ($values as $key => $value) {
            if (is_int($key)) {
                $this->statement->bindValue($key + 1, $value);
            } else {
                $this->statement->bindValue($key, $value);
            }
        }
        $this->statement->execute();
        return $this;

    }

    public function fetchAssoc() {
        return $this->statement->fetch();
    }
    public function fetchAssocAll() {
        return $this->statement->fetchAll();
    }

    public function insert($query, $values) {
        $statement = $this->connection->prepare($query);
        foreach ($values as $key => $value) {
            if (is_int($key)) {
                $statement->bindValue($key + 1, $value);
            } else {
                $statement->bindValue($key, $value);
            }
        }
        $statement->execute();
        return $statement;
    }

    public function update($query, $values) {
        $statement = $this->connection->prepare($query);
        foreach ($values as $key => $value) {
            if (is_int($key)) {
                $statement->bindValue($key + 1, $value);
            } else {
                $statement->bindValue($key, $value);
            }
        }
        $statement->execute();
        return $statement;
    }
}