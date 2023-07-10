<?php

namespace Test;

use Phug\Util\TestCase;
use Work\Soft_Expert\Api;
use Work\Soft_Expert\DB\Models\User;

class LoginTest extends TestCase {
    protected int $users_count = 0;

    protected function init(): void {
        if ($this->users_count !== 0) {
            return;
        }
        
        $this->users_count = $this->test_to_get_users_list();        
    }

    public function test_to_get_users_list(): int{
        $users = User::read();
        $this->assertIsArray($users);

        return count($users);
    }

    public function test_if_user_addition_it_works(): void {
        $this->init();
        $count = $this->users_count + 1;

        $faker = Faker\Factory::create();

        User::create([
            'username' => "soft_expert_$count",
            'email' => $faker->email,
            'password' => 'soft-expert',
            'display_name' => $faker->name,
        ]);

        $this->assertGreaterThan($this->users_count, $this->test_to_get_users_list());
    }
    
    public function test_if_user_will_be_able_to_login_via_api(): void {
        $this->assertEmpty([]);
    }
    
    public function test_login_with_invalid_credentials(): void {
        $this->assertEmpty([]);
    }
}
