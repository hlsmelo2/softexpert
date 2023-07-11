<?php

namespace Test;

use Phug\Util\TestCase;
use Work\Soft_Expert\Api;

class TaxTest extends TestCase {
    protected int $taxes_count = 0;

    protected function init(): void {
        if ($this->taxes_count !== 0) {
            return;
        }
        
        $this->taxes_count = $this->test_to_get_taxes_list();        
    }

    public function test_to_get_taxes_list(): int {
        $taxes = Helpers::json_parse( Api::get_taxes() );
        $this->assertIsArray($taxes);

        return count($taxes);
    }

    public function test_to_insert_taxes(): void {
        $this->init();
        $count = $this->taxes_count + 1;

        $tax = [
            'name' => "Tax {$count}",
            'value' => Helpers::get_money_increment(10, $count),
        ];

        Api::register_tax($tax);
        $this->assertGreaterThan($this->taxes_count, $this->test_to_get_taxes_list());
    }
}