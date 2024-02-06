<?php

namespace Lovro\Phpframework\Models;

use Lovro\Phpframework\Connection;
use Lovro\Phpframework\Traits\HasTimestamps;

abstract class Model
{
    use HasTimestamps;

    protected array $columns = [];

    abstract static function getTableName();

    public function __get($name) {
        return $this->columns[$name];
    }

    public function __set($name, $value) {
        return $this->columns[$name] = $value;
    }

    function saveModel() 
    {
        $this->enableTimestamps();
        if($this->timestampsEnabled) {
            $this->setCreatedAt();
        }
        
        Connection::getInstance()->insert('INSERT INTO ' . static::getTableName() . '(name, created_at) VALUES (?,?)', [$this->columns['name'], $this->columns['created_at']]);
        $this->columns['id'] = Connection::getInstance()->lastInsertId();
    }

    function updateModel() 
    {
        $this->enableTimestamps();
        if($this->timestampsEnabled) {
            $this->setUpdatedAt();
        }

        Connection::getInstance()->update('UPDATE users SET name = ?, updated_at = ? WHERE id = ?', [$this->columns['name'], $this->columns['updated_at'], $this->columns['id']]);
        $this->columns['updated_at'] = date('Y-m-d H:i:s');
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

    public static function delete($id) {
        $db = Connection::getInstance()->select('SELECT * FROM ' . static::getTableName() . ' WHERE id = ?', [$id])->fetchAssoc();
        if ($db) {
            Connection::getInstance()->select('DELETE FROM ' . static::getTableName() . ' WHERE id = ?', [$id]);
            return true;
        }
    }

    public  function softDelete($id) {
        $db = Connection::getInstance()->select('SELECT * FROM ' . static::getTableName() . ' WHERE id = ?', [$id])->fetchAssoc();
        if ($db)
        {
            $this->enableTimestamps();
            if($this->timestampsEnabled) {
                $this->setDeletedAt();
            }

            Connection::getInstance()->update('UPDATE users SET deleted_at = ? WHERE id = ?', [$this->columns['deleted_at'], $this->columns['id']]);
        }
    }

    public function toArray() {
        return $this->columns;
    }
}