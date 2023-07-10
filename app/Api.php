<?php

namespace Work\Soft_Expert;

use Work\Soft_Expert\DB\Models\Product;
use Work\Soft_Expert\DB\Models\Product_Type;
use Work\Soft_Expert\DB\Models\Sale;
use Work\Soft_Expert\DB\Models\Tax;
use Work\Soft_Expert\DB\Models\User;

class Api {
    const PREFIX = '/api';

    static protected function get_params(array $params = []): array {
        return $params['params'];
    }
    
    static protected function get_response(string $type, string $message = null, array $data = null) {
        $data = ($data === null) ? [] : $data;
        $data['message'] = isset( $data['message'] ) ? $data['message'] : $message;
        $data['done'] = ($type === 'error') ? false : true;

        return json_encode($data);
    }
    
    static protected function get_json_safe_list(array $list = []): string {
        $empty = $list === null || count($list) === 0;
        $safe_list = $empty ? [] : $list;

        return json_encode($safe_list);
    }
    
    static public function get_product($params): string {
        return self::get_response('success', '', [
            'product' => Product::get(self::get_params($params)),
        ]);
    }

    static public function get_products($params): string {
        return self::get_json_safe_list( Product::read( self::get_params($params) ) );        
    }
    
    static public function register_user($params) {
        $params = self::get_params($params);

        if ( ! User::create($params) ) {
            return self::get_response('error', 'An error occurred while trying to register the user');
        };

        return self::get_response('success', '', [
            'message' => 'The user was registered',
            'args' => $params,
        ]);
    }

    static public function login($params) {
        $token = AuthGuard::get_login_token( (object) self::get_params($params) );

        if ($token === null) {
            return self::get_response('error', 'Login or password is wrong');
        };

        return self::get_response('success', '', [
            'token' => $token,
        ]);
    }
    
    static public function logout($params) {
        // kill tokns
    }
    
    static public function register_sale($params) {
        $params = self::get_params($params);

        if ( ! Sale::create($params) ) {
            return self::get_response('error', 'An error occurred while trying to register the sale');
        };

        return self::get_response('success', '', [
            'message' => 'The sale was registered',
            'args' => $params,
        ]);
    }
    
    static public function register_product($params) {
        $params = self::get_params($params);

        if ( ! Product::create($params) ) {
            return self::get_response('error', 'An error occurred while trying to register the product');
        };

        return self::get_response('success', '', [
            'message' => 'The product was registered',
            'args' => $params,
        ]);
    }

    static public function get_product_types() {
        return self::get_json_safe_list( Product_Type::read() );
    }
    
    static public function register_product_type($params) {
        $params = self::get_params($params);

        if ( ! Product_Type::create($params) ) {
            return self::get_response('error', 'An error occurred while trying to register the product type');
        };

        return self::get_response('success', '', [
            'message' => 'The product type was registered',
            'args' => $params,
        ]);
    }

    static public function get_taxes() {
        return self::get_json_safe_list( Tax::read() );
    }

    static public function register_tax($params) {
        $params = self::get_params($params);
        
        if ( ! Tax::create($params) ) {
            return self::get_response('error', 'An error occurred while trying to register the tax');
        };

        return self::get_response('success', '', [
            'message' => 'The tax was registered',
            'args' => $params,
        ]);
    } 
}
