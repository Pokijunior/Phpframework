<?php

namespace Lovro\Phpframework\Models;

class User extends Model
{
    const TABLE_NAME = 'users';
    public static function getTableName() {
        return self::TABLE_NAME;
    }
}