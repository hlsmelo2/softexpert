<?php

namespace Work\Soft_Expert\DB\Models;

use Work\Soft_Expert\DB\DB;

class User {
    const TABLE_NAME = 'users';
    const DEFAULT_IMAGE = '';

    static public function read(): array {
        return DB::read('SELECT * FROM se_users');
    }
    
    static public function create(array $data): bool {
        unset($data['re_password']);
        $data['password'] = md5($data['password']);
        
        return DB::create(self::TABLE_NAME, $data);
    }
    
    static public function update(array $data): bool {
        return DB::create(self::TABLE_NAME, $data);
    }
    
    static public function delete(array $data): bool {
        return DB::delete(self::TABLE_NAME, $data);
    }
}
