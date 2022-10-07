<?php

namespace Tests\Feature\Api\Auth;

use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Support\Str;

class LoginControllerTest extends TestCase
{
    public $auth;

    protected function setUp() :void
    {
        parent::setUp();

        $this->auth = User::where('email', 'new_user_email@ivas.com')->first();
    }

    public function test_user_register()
    {
        $data = [
            'name' => "New User Name",
            'email' => "new_user_email@ivas.com",
            'password' => 123,
            'password_confirmation' => 'P@$$w0rd',
            'department_id' => Department::first()->id,
            'behalf_id' => User::first()->id,
        ];

        $this->post('api/register', $data)
                ->assertSessionHasNoErrors()
                ->assertJsonStructure(['success', 'message', 'token', 'user' => ['id', 'name', 'email']])
                ->assertStatus(200)
                ->assertJson([
                                'message' => trans('permissions.account not acctive'),
                                'success' => true,
                                'user' => ['name' => $data['name']]
                            ]);
    }

    public function test_user_login()
    {
        $this->post('api/login', ['email' => $this->auth->email, 'password' => 123])
                ->assertSessionHasNoErrors()
                ->assertJsonStructure(['success', 'message', 'token', 'user' => ['id', 'name', 'email']])
                ->assertStatus(200)
                ->assertJson(['message' => 'User login successfully.', 'success' => true, 'user' => ['name' => $this->auth->name]]);
    }

    public function test_user_details()
    {
        Passport::actingAs($this->auth);
        $this->get('api/details')
                ->assertSessionHasNoErrors()
                ->assertJsonStructure(['data' => ['id', 'name', 'email']])
                ->assertStatus(200)
                ->assertJson(['data' => ['id' => $this->auth->id, 'name' => $this->auth->name, 'email' => $this->auth->email]]);
    }

    public function test_user_refresh_token()
    {
        Passport::actingAs($this->auth);
        $this->post('api/refresh_token')
                ->assertSessionHasNoErrors()
                ->assertJsonStructure(['success', 'message', 'token'])
                ->assertStatus(200)
                ->assertJson(['message' => 'Token refreshed successfully.', 'success' => true]);
    }

    public function test_user_save_mobile_token()
    {
        Passport::actingAs($this->auth);
        $this->post('api/save-mobile-token', ['mobile_token' => Str::random(50)])
                ->assertSessionHasNoErrors()
                ->assertJsonStructure(['success', 'message', 'token', 'user' => ['id', 'name', 'email']])
                ->assertStatus(200)
                ->assertJson(['message' => 'Mobile token saved successfully.', 'success' => true, 'user' => ['name' => $this->auth->name]]);
    }

    public function test_user_logout()
    {
        Passport::actingAs($this->auth);
        $this->post('api/logout')
                ->assertStatus(200)
                ->assertJsonStructure(['success', 'message'])
                ->assertJson(['message' => 'Logged Out successfully', 'success' => true]);
    }
}
