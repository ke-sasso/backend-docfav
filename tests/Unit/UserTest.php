<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;


    public function test_can_create_user()
    {
        $userData = [
            'name' => 'John Doe',
            'username' => 'john',
            'email'=>'prueba1@gmail.com',
            'address'=>'prueba1@gmail.com',
            'phonenumber'=>'121212',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ];
        $response = $this->post('/api/v1/user/create', $userData);
        $response->assertStatus(201);
    }

    public function test_can_read_user()
    {

        $userData = [
            'name' => 'John Doe',
            'username' => 'john',
            'email'=>'prueba1@gmail.com',
            'address'=>'prueba1@gmail.com',
            'phonenumber'=>'121212',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ];
        $user = $this->post('/api/v1/user/create', $userData);
        $response = $this->get("/api/v1/user/datos/".$user['user']['id']);

        $response->assertStatus(201);
    }

    public function test_can_update_user()
    {

        $userData = [
            'name' => 'John Doe',
            'username' => 'john',
            'email'=>'prueba1@gmail.com',
            'address'=>'prueba1@gmail.com',
            'phonenumber'=>'121212',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ];
        $user = $this->post('/api/v1/user/create', $userData);
        $newUserData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ];
        $response = $this->put("/api/v1/user/update/".$user['user']['id'], $newUserData);
        $response->assertStatus(200);
    }

    public function test_can_delete_user()
    {
        $userData = [
            'name' => 'John Doe',
            'username' => 'john',
            'email'=>'prueba1@gmail.com',
            'address'=>'prueba1@gmail.com',
            'phonenumber'=>'121212',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ];
        $user = $this->post('/api/v1/user/create', $userData);
        $response = $this->delete("/api/v1/user/delete/".$user['user']['id']);
        $response->assertStatus(201);
    }
}
