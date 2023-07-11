<?php

namespace Work\Soft_Expert\Router;

use Symfony\Component\VarDumper\VarDumper;
use Work\Soft_Expert\Api;
use Work\Soft_Expert\AuthGuard;
use Work\Soft_Expert\Renderer;
use Work\Soft_Expert\Router\Routes\Api as RoutesApi;
use Work\Soft_Expert\Router\Routes\Web;

class Router {
    static protected string $current_route = '';

    static public function get_current_route(): string {
        if (self::$current_route !== '') {
            return self::$current_route;
        }

        preg_match_all('/[^?#]+/', $_SERVER['REQUEST_URI'], $matches);
        
        self::$current_route = (
            (
                $matches !== null &&
                count($matches) > 0 &&
                $matches[0][0] !== null
            ) ? $matches[0][0] : ''
        );
        
        return self::$current_route;
    }

    static protected function get_route_params(object $route): array {
        preg_match_all($route->new_path, self::get_current_route(), $matches);
        $params = ($matches === null) ? [] : $matches;
        $params2 = !isset($route->parameters) ? [] : $route->parameters;
        
        return ['params' => array_merge($params, $params2, $_GET, $_POST, $_FILES) ];
    }
    
    static protected function get_file_extension(string $route_destination): string {
        $split = explode('.', $route_destination);        
        
        return $split[ count($split) - 1 ];         
    }
    
    static protected function give_new_path(object $route): string {
        $path = $route->path;
        $regex = '#^%s/?$#';

        preg_match_all('/\{([^\}]+)\}/', $path, $matches);

        if ( count($matches[0]) === 0 ) {
            $route->new_path = $path;
            
            return sprintf($regex, $route->new_path);
        }

        $new_path = preg_replace('/\{/', '(?<', $path);
        $new_path = preg_replace('/\}/', '>.+)', $new_path);
        $route->new_path = sprintf($regex, $new_path);

        return $route->new_path;
    }
    
    static protected function is_route(object $route): bool {
        $new_path = self::give_new_path($route);

        if ($new_path === '/' && $new_path === self::get_current_route()) {
            return true;
        }

        preg_match_all($new_path, self::get_current_route(), $matches);
    
        return $matches !== null && count($matches[0]) > 0;
    }
    
    static protected function is_method(object $route): bool {
        if ($route->method !== $_SERVER['REQUEST_METHOD']) {
            return false;
            // die('This route dont accept the used method in request');
        }

        return true;
    }
    
    static protected function handle_route(object $route, $is_api_route): void {
        if ($is_api_route) {
            echo call_user_func( $route->destination, self::get_route_params($route) );
            
            return;
        }

        $path = __DIR__ . '/../../views/';
        $filename = $path . $route->destination;
        $params = self::get_route_params($route);
        
        if (self::get_file_extension($route->destination) === 'pug') {
            echo Renderer::get_rendered_file($filename, $params['params']);
            
            return;
        }
        
        echo Renderer::get_rendered_file($filename, $params['params'], true);
    }
    
    static protected function do($is_api_route = false): bool {
        $routes = $is_api_route ? RoutesApi::routes : Web::routes;
        
        foreach ($routes as $route) {
            $route = (object) $route;

            if (self::is_route($route) && self::is_method($route) && AuthGuard::authorized($route, $is_api_route)) {
                self::handle_route($route, $is_api_route);    
                
                return true;
            }
        }

        // header('location: /404');

        return false;
    }
    
    static public function init(): bool {
        $is_api_route = (strpos( self::get_current_route(), Api::PREFIX ) === 0) ? true : false;
        
        return self::do($is_api_route);
    }
}