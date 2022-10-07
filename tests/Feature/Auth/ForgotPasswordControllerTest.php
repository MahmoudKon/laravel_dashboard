<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class ForgotPasswordControllerTest extends TestCase
{
    use WithFaker;

    public $email, $user;

    protected function setUp() :void
    {
        parent::setUp();

        Notification::fake();
        $this->email = 'mahmoud.mohammed@ivas.com.eg';
        $this->user  = User::where('email', $this->email)->first();
    }

    public function test_user_password_reset_view()
    {
        $this->get('password/reset')->assertStatus(200);
    }

    public function test_user_password_reset_send_link()
    {
        $this->post('password/email', ['email' => $this->email])
                ->assertStatus(302)
                ->assertRedirect('/');

        Notification::assertSentTo($this->user, ResetPassword::class);
    }

    public function test_user_password_reset()
    {
        $data = [
            'email' => $this->email,
            'password' => 'P@$$w0rd',
            'password_confirmation' => 'P@$$w0rd',
            'token' => Password::createToken(User::where('email', $this->email)->first())
        ];

        $this->post('password/reset', $data)
                ->assertSessionHasNoErrors()
                ->assertStatus(302)
                ->assertRedirect(RouteServiceProvider::DASHBOARD);
    }
}
