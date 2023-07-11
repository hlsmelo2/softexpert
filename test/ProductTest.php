<?php

namespace Test;

use Phug\Util\TestCase;
use Work\Soft_Expert\Api;

class ProductTest extends TestCase {
    protected int $products_count = 0;

    protected function init(): void {
        if ($this->products_count !== 0) {
            return;
        }
        
        $this->products_count = $this->test_if_be_able_to_get_products_list();
    }

    public function test_if_be_able_to_get_products_list(): int{
        $products = Helpers::json_parse(Api::get_products([]));
        $this->assertIsArray($products);

        return count($products);
    }
    
    public function test_to_insert_products(): void {
        $this->init();
        $count = $this->products_count + 1;

        $product = [
            'name' => "Product {$count}",
            'description' => "Product {$count} description",
            'image' => '',
            'image_file' => null,
            'quantity' => '10',
            'product_type_id' => $count,
            'price' => Helpers::get_money_increment(10, $count),

        ];

        Api::register_product($product);
        $this->assertGreaterThan($this->products_count, $this->test_if_be_able_to_get_products_list());
    }

    public function test_to_get_full_product_list_and_check_tax_property_exists(): void {
        $this->init();

        $products = Helpers::json_parse( Api::get_products(['full' => 1]) );
        $products = ( count($products) > 0 ) ? $products[0] : [[]];

        if ($this->products_count === 1) {
            return;
        };

        $this->assertArrayHasKey('tax', $products);
    }

    public function test_to_get_product_list_and_check_tax_property_dont_exists(): void {
        $products = Helpers::json_parse( Api::get_products([]) );
        $this->assertArrayNotHasKey('tax', $products[0]);
    }
}
