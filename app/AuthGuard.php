<?php

namespace Work\Soft_Expert;

use Exception;
use Firebase\JWT\JWT;
use Work\Soft_Expert\DB\DB;

class AuthGuard {
    const KEY = 'Soft_Expert_Key';
    const ALGORITHM = 'HS256';

    static protected function check_auth(string $token) {
        // JWT::decode();
        // JWT::encode();
        md5('');
        return;
    }
    
    static protected function go_to_login() {
        header('location: /login');
    }
    
    static public function get_login_token(object $params): string | null {
        $params->username = isset($params->username) ? $params->username : null;
        
        $query = sprintf(
            "SELECT * FROM se_users u WHERE (u.username = '%s' OR u.email = '%s') AND u.password = '%s'",
            $params->username,
            $params->username,
            md5($params->password),
        );
        
        $execute = DB::execute($query);

        if (count($execute) === 0) {
            return null;
        }

        $payload = [
            'exp' => time() + 3600,
            'iat' => time(),
            'email' => $execute[0]['email'],
        ];

        $token_ob = JWT::encode($payload, self::KEY, self::ALGORITHM);
        $token = json_encode($token_ob);

        session_start();
        $_SESSION['token'] = $token;
        session_write_close();

        return $token;
    }
    
    static protected function get_token() {        
        if ( isset($_SERVER['HTTP_AUTHORIZATION']) ) {
            return str_replace('Bearer ', '', $_SERVER['HTTP_AUTHORIZATION']);
        }

        session_start();
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : null;
        session_write_close();

        return $token;
    }

    static protected function handle_web_route(object $route, $token) {
        if ($token === null) {
            self::go_to_login();

            return false;
        }
    }

    static protected function handle_api_route(object $route, $token) {
        if ($token === null) {
            echo 'Authentication is required to use this feature.';

            return false;
        }
    }
    
    static protected function default(object $route, bool $is_api_route) {
        $token = self::get_token();

        try {
            if ($token !== null) {
                $token = JWT::decode($token, self::KEY); 
            }
        } catch (Exception $e) {
            $token = null;
        }

        if ($is_api_route) {
            return self::handle_api_route($route, $token);
        }
        
        return self::handle_web_route($route, $token);
    }
    
    static public function authorized(object $route, bool $is_api_route) {
        return true;
        
        if (! isset($route->protected)) {
            return true;
        }

        return self::{$route->protected}($route, $is_api_route);
    }
}
