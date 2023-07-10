<?php

namespace Work\Soft_Expert;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Work\Soft_Expert\DB\DB;

class AuthGuard {
    const KEY = 'Soft_Expert_Key';
    const ALGORITHM = 'HS256';
    
    static protected function go_to_login() {
        header('location: /login');
    }
    
    static protected function get_user_trying_login (object $params): array | null {
        $params->username = isset($params->username) ? $params->username : null;
        
        $query = sprintf(
            "SELECT * FROM se_users u WHERE (u.username = '%s' OR u.email = '%s') AND u.password = '%s'",
            $params->username,
            $params->username,
            md5($params->password),
        );
        
        return DB::execute($query);
    }
    
    static protected function get_payload(string $email): array {
        return [
            'exp' => time() + 3600,
            'iat' => time(),
            'email' => $email,
        ];
    }
    
    static protected function write_session(string $property, $data): void {
        session_start();
        $_SESSION[$property] = $data;
        session_write_close();
    }
    
    static public function get_login_token(object $params): string | null {
        $user_trying_login = self::get_user_trying_login($params);

        if (count($user_trying_login) !== 1) {
            return null;
        }


        $payload = self::get_payload( $user_trying_login[0]['email'] );
        $token_ob = JWT::encode($payload, self::KEY, self::ALGORITHM);
        $token = json_encode($token_ob);
        self::write_session('token', $token);

        return $token;
    }
    
    static protected function read_session($property) {
        session_start();
        $token = isset($_SESSION[$property]) ? $_SESSION[$property] : null;
        session_write_close();

        return $token;
    }

    static protected function get_api_token(): string | null {
        if ( ! isset($_SERVER['HTTP_AUTHORIZATION']) ) {
            return null;
        }
        
        return str_replace('Bearer ', '', $_SERVER['HTTP_AUTHORIZATION']);
    }

    static protected function get_web_token(): string | null {        
        return self::read_session('token');
    }

    static protected function handle_web_route(object $route, $token): bool {
        if ($token !== null) {
            return true;
        }
        
        self::go_to_login();

        return false;
    }

    static protected function handle_api_route(object $route, $token) {
        if ($token !== null) {
            
            return true;
        }
        
        echo 'Authentication is required to use this feature.';
        
        return false;
    }
    
    static protected function default(object $route, bool $is_api_route) {
        $token = $is_api_route ? self::get_api_token() : self::get_web_token();
        $token = str_replace('"', '', $token);
        
        try {
            if ($token !== null) {
                $token = JWT::decode( $token, new Key(self::KEY, self::ALGORITHM) ); 
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
        if (! isset($route->protected)) {
            return true;
        }

        return self::{$route->protected}($route, $is_api_route);
    }
}
