<?php

namespace Test;

use Phug\Util\TestCase;
use Work\Soft_Expert\Renderer;


class RendererTest extends TestCase {
    public function test_if_renderer_be_able_render_pug_file(): void {
        $this->assertIsString(Renderer::get_rendered_file(__DIR__ . '/../views/home.php.pug'));
    }
}
