<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_login_form()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_user_duplication()
    {
        $user1 = User::make([
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com'
        ]);

        $user2 = User::make([
            'name' => 'Code With Dary',
            'email' => 'dary@gmail.com'
        ]);


        $this->assertTrue($user1->name != $user2->name);


    }

    public function test_delete_user()
    {
        $user = User::factory()->count(1)->make();

        $user = User::first();

        if($user) {
            $user->delete();
        }

        $this->assertTrue(true);

    }

    public function test_it_stores_new_users()
    {
        $response = $this->post('/register', [
            'name' => 'dary',
            'email' => 'dary@gmail.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234'
        ]);

        $response->assertRedirect('/home');  
    }

    public function test_has_value_database()
    {
        $this->assertDatabaseHas('users', [
            'name' => 'Dary',
        ]);
    }

    public function test_missing_value_database()
    {
        $this->assertDatabaseMissing('users', [
            'name' => 'Dar',
        ]);
    }

    public function test_if_seeders_works()
    {
        $this->seed(); // seed all seeders in th sders folder
        // php artisan db:seed
    }
}
