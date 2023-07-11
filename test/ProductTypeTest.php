<?php

namespace Test;

use Phug\Util\TestCase;
use Work\Soft_Expert\Api;

class ProductTypeTest extends TestCase {

    protected int $product_types_count = 0;


    protected function init(): void {
        if ($this->product_types_count !== 0) {
            return;
        }
        
        $this->product_types_count = $this->test_to_get_product_types_list();
    }

    public function test_to_get_product_types_list(): int {
        $product_types = Helpers::json_parse( Api::get_product_types() );
        $this->assertIsArray($product_types);

        return count($product_types);
    }
    
    public function test_to_insert_product_types(): void {
        $this->init();
        $count = $this->product_types_count + 1;

        $product_type = [
            'name' => "Product type {$count}",
            'description' => "Product type {$count} description",
            'tax_id' => $count,
        ];

        Api::register_product_type($product_type);
        $this->assertGreaterThan($this->product_types_count, $this->test_to_get_product_types_list());
    }
}
