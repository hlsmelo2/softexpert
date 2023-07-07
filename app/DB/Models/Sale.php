<?php

namespace Work\Soft_Expert\DB\Models;

use Work\Soft_Expert\DB\DB;

class Sale {
    const TABLE_NAME = 'sales';

    static public function read(): array {
        return DB::read('SELECT * FROM se_sales');
    }
    
    static public function create(array $data) {
        $query = sprintf(
            'INSERT INTO se_sales (total, total_taxes) VALUES (%s,%s) RETURNING id',
            $data['total'],
            $data['total_taxes'],
        );

        $sale_id = DB::execute($query);
        $sale_id = count($sale_id) > 0 ? $sale_id[0]['id'] : 0;
        $cart = json_decode($data['cart'], true);

        foreach ($cart as $item) {
            $item['sale_id'] = $sale_id;
            unset($item['product']);

            
            if ( Sale_Product::create($item) ) {
                return false;
            }
        }
    }
    
    static public function update(array $data) {
        DB::create(self::TABLE_NAME, $data);
    }
    
    static public function delete(array $data) {
        DB::delete(self::TABLE_NAME, $data);
    }
}