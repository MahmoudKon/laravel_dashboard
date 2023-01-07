<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    public function test_register_page()
    {
        $status = Route::has('register') ? 200 : 404;
        $this->get('register')->assertStatus($status);
    }

    public function test_register_post()
    {
        $data = [
            'name' => 'New User Name',
            'email' => 'new_user_email@app.come',
            'password' => 'P@$$w0rd',
            'password_confirmation' => 'P@$$w0rd'
        ];

        $this->post('register', $data)
                ->assertSessionHasNoErrors()
                ->assertStatus(302)
                ->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_login_page()
    {
        $this->get('login')->assertStatus(200);
    }

    public function test_login_post()
    {
        $this->post('login', ['email' => 'new_user_email@app.come', 'password' => 'P@$$w0rd'])
                ->assertStatus(302)
                ->assertSessionHasNoErrors()
                ->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_logout_user()
    {
        $this->actingAs(User::first())
                ->post('logout')
                ->assertStatus(302)
                ->assertRedirect('login');
    }
}
