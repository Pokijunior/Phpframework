<?php

namespace Lovro\Phpframework;

use PDO;
use PDOStatement;
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

class Connection {
    private static ?Connection $instance = null;
    private ?PDO $connection;
    private $statement;

    private function __construct() {
        $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';port=' . $_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_NAME'];
        
        $this->connection = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }

    public static function getInstance(): Connection
    {
        if (self::$instance === null) {
            self::$instance = new Connection();
        }

        return self::$instance;
    }
    
    public function select($query, $values): self
    {
        $this->statement = $this->connection->prepare($query);
        foreach ($values as $key => $value) {
            if (is_int($key)) {
                $this->statement->bindValue($key + 1, $value);
            }
        }
        $this->statement->execute();
        return $this;
    }

    public function fetchAssoc(): ?array
    {
        $result = $this->statement->fetch();
        return ($result !== false) ? $result : null;
    }
    public function fetchAssocAll(): ?array
    {
        $result = $this->statement->fetchAll();
        return ($result !== false) ? $result : null;
    }

    public function insert(string $query, array $values): PDOStatement
    {
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

    public function update(string $query, array $values): PDOStatement
    {
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

    public function delete(string $query, array $values): PDOStatement
    {
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

    public function lastInsertId(): ?string
    {
        return $this->connection->lastInsertId();
    }
}