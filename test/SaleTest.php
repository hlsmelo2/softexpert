<?php


namespace Test;

use Phug\Util\TestCase;
use Work\Soft_Expert\Api;
use Work\Soft_Expert\DB\Models\Sale;

class SaleTest extends TestCase {
    protected int $sales_count = 0;

    protected function init(): void {
        if ($this->sales_count !== 0) {
            return;
        }
        
        $this->sales_count = $this->test_to_get_sales_list();        
    }

    public function test_to_get_sales_list(): int{
        $sales = Sale::read();
        $this->assertIsArray($sales);

        return count($sales);
    }

    public function test_if_sale_addition_it_works(): void {
        $cart_data = [
            'cart' => [
                [
                    "quantity" => 2,
                    "product" =>  [
                        "id" => 1,
                        "name" => "Produto 1",
                        "description" => "Produto 1",
                        "image" => "/public/assets/images/product-image-sample.png",
                        "quantity" => 10,
                        "price" => "R$ 10,02",
                        "type_name" => "Produto tipo 1",
                        "tax_name" => "Taxa 1",
                        "tax" => "R$ 10,02",
                    ],
                    "subtotal" => "R$ 70,14",
                    "subtotalTaxes" => "7.03",
                ],
            ],
            "total" => "140.28",
            "total_taxes" => "14.06",
        ];

        $this->init();
        Api::register_sale($cart_data);

        $this->assertGreaterThan($this->sales_count, $this->test_to_get_sales_list());
    }    
}
