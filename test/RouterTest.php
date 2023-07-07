<?php

namespace Test;

use Phug\Util\TestCase;
use Work\Soft_Expert\Router\Router;

class RouterTest extends TestCase {
    public function test_if_get_route_params_it_works(): void {
        $router = new Router();
        
        $params = Helpers::callMethod($router, 'get_route_params', [
            (object) [ 'new_path' => '#/#' ]
        ]);

        $this->assertIsArray($params);
    }
}
