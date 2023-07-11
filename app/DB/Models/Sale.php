<?php

namespace Work\Soft_Expert\DB\Models;

use Work\Soft_Expert\Controllers\SaleController;
use Work\Soft_Expert\DB\DB;
use Work\Soft_Expert\DB\Model;

class Sale extends Model {
    const TABLE_NAME = 'sales';

    static public function create(array $data, bool $return_id = false): bool {
        $cart = $data['cart'];
        unset($data['cart']);
        // $sale_id = DB::execute( self::get_returning_query_insert($data) );
        $sale_id = DB::create(self::TABLE_NAME, $data, true);
        // $sale_id = count($sale_id) > 0 ? $sale_id[0]['id'] : 0;
        $cart_data = !is_string($cart) ? $cart : json_decode($cart, true);
        
        
        foreach ($cart_data as $item) {
            if ( 
                !Sale_Product::create( SaleController::get_new_item($item, $sale_id) )
            ) {
                return false;
            }
        }

        return true;
    }
}