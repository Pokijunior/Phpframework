<?php

namespace Lovro\Phpframework\Models;

use Lovro\Phpframework\Connection;

abstract class Model
{
    protected array $columns = [];

    abstract static function getTableName();

    public function __get($name) {
        return $this->columns[$name];
    }

    public function __set($name, $value) {
        return $this->columns[$name] = $value;
    }

    function saveModel() {
        Connection::getInstance()->insert('INSERT INTO ' . static::getTableName() . '(name) VALUES (?)', [$this->columns['name']]);
        $this->columns['id'] = Connection::getInstance()->lastInsertId();
    }

    function updateModel() {
        Connection::getInstance()->update('UPDATE users SET name = ? WHERE id = ?', [$this->columns['name'], $this->columns['id']]);
    }


    public function save() {
        if(isset($this->columns['id']) && $this->columns['id'] !== null) {
            self::updateModel();
        } else {
            self::saveModel();
        }
    }

    public static function findById($id) {
        $db = Connection::getInstance()->select('SELECT * FROM ' . static::getTableName() . ' WHERE id = ?', [$id])->fetchAssoc();
        if ($db) {
            $model = new static();
            $model->columns = $db;
            return $model;
        } else {
            return new User();
        }
    }

    public function toArray() {
        return $this->columns;
    }
}