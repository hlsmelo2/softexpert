<?php

namespace Work\Soft_Expert;

use Phug\Phug;
use Work\Soft_Expert\Router\Router;

class Renderer {
    static public function can_show_this(string $element): bool {
        $table = [
            'menu' => ['/login'],
            'minicart' => ['/buy', '/login'],
        ];

        $route_path = Router:: get_current_route();

        if ( !in_array($route_path, $table[$element] ) ) {
            return true;
        }
        
        return false;
    }
    
    static protected function get_new_data($data): array {
        return ($data === null) ? [] : $data;
    }
    
    static protected function turn_getable_pug(string $action, string $lines_filename, $data): string {
        ob_start();

        Phug::{$action}( $lines_filename, self::get_new_data($data) );

        return ob_get_clean();
    }

    static protected function get_rendered_other_lines(string $lines, $data): string {
        ob_start();

        $data;
        echo $lines;
        
        return ob_get_clean();
    }

    static protected function get_rendered_other_file(string $filename, $data): string {
        ob_start();

        $data;
        require_once $filename;
        
        return ob_get_clean();
    }
    
    static public function get_rendered_lines(string $lines, $data = [], $is_non_pug = false): string{
        return ($is_non_pug) ? self::get_rendered_other_lines($lines, $data) : self::turn_getable_pug('display', $lines, $data);
    }
    
    static public function get_rendered_file(string $filename, $data = [], $is_non_pug = false): string {
        if (! file_exists($filename)) {
            die("The file $filename don't exists");
        }

        return ($is_non_pug) ? self::get_rendered_other_file($filename, $data) : self::turn_getable_pug('displayFile', $filename, $data);
    }
}
