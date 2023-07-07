<?php

namespace Test;

use Phug\Util\TestCase;

class LoginTest extends TestCase {
    public function test_if_user_will_be_able_to_login_via_api(): void {
        $this->assertEmpty([]);
    }
    
    public function test_login_with_invalid_credentials(): void {
        $this->assertEmpty([]);
    }
}
