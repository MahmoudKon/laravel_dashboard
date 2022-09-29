<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public $credential  = ['email' => 'super_admin@app.com', 'password' => "123"];

    public function test_login_page()
    {
        $this->get('login')->assertStatus(200);
    }

    public function test_login_user()
    {
        $this->post('login', $this->credential)
                ->assertStatus(302)
                ->assertSessionHasNoErrors()
                ->assertRedirect('dashboard');
    }

    public function test_logout_user()
    {
        $user = User::first();
        $this->actingAs($user)
                ->assertAuthenticatedAs($user, 'web')
                ->post('logout')
                ->assertStatus(302)
                ->assertRedirect('login');
    }

    public function test_redirect_from_login_page()
    {
        $user = User::first();
        $this->actingAs($user)
                ->assertAuthenticatedAs($user, 'web')
                ->get('login')
                ->assertStatus(302)
                ->assertRedirect("home");
    }
}
