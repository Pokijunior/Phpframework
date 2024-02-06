<?php

namespace Lovro\Phpframework\Models;

use Lovro\Phpframework\Connection;
use Lovro\Phpframework\Traits\HasTimestamps;

abstract class Model
{
    use HasTimestamps;

    protected array $columns = [];

    abstract static function getTableName();

    public function __get($name) 
    {
        return $this->columns[$name];
    }

    public function __set($name, $value) 
    {
        return $this->columns[$name] = $value;
    }

    function saveModel() 
    {
        if($this->timestampsEnabled) {
            $this->setCreatedAt();
            Connection::getInstance()->insert('INSERT INTO ' . static::getTableName() . '(name, created_at) VALUES (?,?)', [$this->columns['name'], $this->columns['created_at']]);
            $this->columns['id'] = Connection::getInstance()->lastInsertId();
        } else {
            Connection::getInstance()->insert('INSERT INTO ' . static::getTableName() . '(name) VALUES (?)', [$this->columns['name']]);
            $this->columns['id'] = Connection::getInstance()->lastInsertId();
        }
        
        
    }

    function updateModel() 
    {
        if($this->timestampsEnabled) {
            $this->setUpdatedAt();
            Connection::getInstance()->update('UPDATE users SET name = ?, updated_at = ? WHERE id = ?', [$this->columns['name'], $this->columns['updated_at'], $this->columns['id']]);
        } else {
            Connection::getInstance()->update('UPDATE users SET name = ? WHERE id = ?', [$this->columns['name'], $this->columns['id']]);
        }
    }


    public function save() 
    {
        if(isset($this->columns['id']) && $this->columns['id'] !== null) {
            self::updateModel();
        } else {
            self::saveModel();
        }
    }

    public static function findById($id) 
    {
        $db = Connection::getInstance()->select('SELECT * FROM ' . static::getTableName() . ' WHERE id = ?', [$id])->fetchAssoc();
        if ($db) {
            $model = new static();
            $model->columns = $db;
            return $model;
        } else {
            return null;
        }
    }

    public static function delete($id) 
    {
        Connection::getInstance()->select('DELETE FROM ' . static::getTableName() . ' WHERE id = ?', [$id]);
    }

    public  function softDelete($id) 
    {
        if($this->timestampsEnabled) {
            $this->setDeletedAt();
            Connection::getInstance()->update('UPDATE users SET deleted_at = ? WHERE id = ?', [$this->columns['deleted_at'], $this->columns['id']]);
        }


    }

    public function toArray() {
        return $this->columns;
    }
}