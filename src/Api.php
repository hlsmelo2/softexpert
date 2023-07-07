<?php

namespace Work\Soft_Expert;

use Work\Soft_Expert\DB\Models\Product;
use Work\Soft_Expert\DB\Models\Product_Type;
use Work\Soft_Expert\DB\Models\Sale;
use Work\Soft_Expert\DB\Models\Tax;

class Api {
    const PREFIX = '/api';

    static protected function get_response(string $type, string $message = null, array $data = null) {
        $data = ($data === null) ? [] : $data;
        $data['message'] = isset( $data['message'] ) ? $data['message'] : $message;
        $data['done'] = ($type === 'error') ? false : true;

        return json_encode($data);
    }
    
    static public function get_products($params) {
        return json_encode( Product::read($params) );
    }
    
    static public function register_sale($params) {
        if ( ! Sale::create($params) ) {
            return self::get_response('error', 'An error occurred while trying to register the sale');
        };

        return self::get_response('success', '', [
            'message' => 'The sale was registered',
            'args' => $params,
        ]);
    }
    
    static public function register_product($params) {
        if ( ! Product::create($params) ) {
            return self::get_response('error', 'An error occurred while trying to register the product');
        };

        return self::get_response('success', '', [
            'message' => 'The product was registered',
            'args' => $params,
        ]);
    }

    static public function get_product_types() {
        return json_encode( Product_Type::read() );
    }
    
    static public function register_product_type($params) {
        if ( ! Product_Type::create($params) ) {
            return self::get_response('error', 'An error occurred while trying to register the product type');
        };

        return self::get_response('success', '', [
            'message' => 'The product type was registered',
            'args' => $params,
        ]);
    }

    static public function get_taxes() {
        return json_encode( Tax::read() );
    }

    static public function register_tax($params) {
        if ( ! Tax::create($params) ) {
            return self::get_response('error', 'An error occurred while trying to register the tax');
        };

        return self::get_response('success', '', [
            'message' => 'The tax was registered',
            'args' => $params,
        ]);
    } 
}
