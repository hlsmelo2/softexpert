<?php

namespace Work\Soft_Expert\DB\Models;

use Work\Soft_Expert\DB\DB;

class Tax {
    const TABLE_NAME = 'taxes';

    static public function read(): array {
        return DB::read('SELECT * FROM se_taxes');
    }
    
    static public function create(array $data) {
        return DB::create(self::TABLE_NAME, $data);
    }
    
    static public function update(array $data) {
        DB::create(self::TABLE_NAME, $data);
    }
    
    static public function delete(array $data) {
        DB::delete(self::TABLE_NAME, $data);
    }
}