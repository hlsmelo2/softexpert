<?php

namespace Work\Soft_Expert\Controllers;

class SaleController {
    static protected function get_returning_query_insert(array $data) {
        return sprintf(
            'INSERT INTO se_sales (total, total_taxes) VALUES (%s,%s) RETURNING id',
            $data['total'],
            $data['total_taxes'],
        );
    }

    static public function get_new_item(array $item, int $sale_id) {
        $item['sale_id'] = $sale_id;
        unset($item['product']);

        return $item;
    }
}
