<?php

namespace Work\Soft_Expert\DB\Models;

use Work\Soft_Expert\DB\DB;
use Work\Soft_Expert\DB\Model;

class User extends Model {
    const TABLE_NAME = 'users';
    const DEFAULT_IMAGE = '';

    static public function create(array $data, bool $return_id = false): bool {
        unset($data['re_password']);
        $data['password'] = md5($data['password']);
        
        return DB::create(self::TABLE_NAME, $data, false);
    }
}
