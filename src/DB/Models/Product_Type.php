<?php

namespace Work\Soft_Expert\DB\Models;

use Work\Soft_Expert\DB\DB;

class Product_Type {
    const TABLE_NAME = 'product_types';

    static public function read(): array {
        return DB::read('SELECT * FROM se_product_types');
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