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
        $user_password = "soft_expert_{$count}";

        User::create([
            'username' => $user_password,
            'email' => "{$user_password}@soft-expert.com",
            'password' => $user_password,
            'display_name' => 'Soft Expert',
        ]);

        $this->assertGreaterThan($this->users_count, $this->test_to_get_users_list());
    }
    
    public function test_user_login_via_api_using_username(): void {
        $login = Api::login([
            'username' => 'soft_expert_1',
            'password' => 'soft_expert_1',
        ]);

        $login = Helpers::json_parse($login);

        $this->assertArrayHasKey('token', $login);
        $this->assertIsString($login['token']);
    }
    
    public function test_user_login_via_api_using_email(): void {
        $login = Api::login([
            'username' => 'soft_expert_1@soft-expert.com',
            'password' => 'soft_expert_1',
        ]);

        $login = Helpers::json_parse($login);

        $this->assertArrayHasKey('token', $login);
        $this->assertIsString($login['token']);
    }
    
    public function test_user_login_via_api_using_invalid_credentials(): void {
        $login = Api::login([
            'username' => 'soft_expert_1',
            'password' => 'soft_expert_2',
        ]);

        $login = Helpers::json_parse($login);

        $this->assertArrayHasKey('done', $login);
        $this->assertArrayHasKey('message', $login);
        $this->assertEquals('Login or password is wrong', $login['message']);
    }
}
