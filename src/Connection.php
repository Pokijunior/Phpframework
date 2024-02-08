<?php

namespace Lovro\Phpframework;

use Dotenv\Dotenv;
use PDO;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

class Connection {
    private static $instance = null;
    private $connection;
    private $statement;

    private function __construct() {
        $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';port=' . $_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_NAME'];
        
        $this->connection = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Connection();
        }

        return self::$instance;
    }
    
    public function select($query, $values) {
        $this->statement = $this->connection->prepare($query);
        foreach ($values as $key => $value) {
            if (is_int($key)) {
                $this->statement->bindValue($key + 1, $value);
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

    public function delete($query, $values) {
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

    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }
}