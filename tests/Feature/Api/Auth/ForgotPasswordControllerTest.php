<?php

namespace Tests\Feature\Api\Auth;

use App\Mail\ForgetPassword;
use App\Models\PasswordPinCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ForgotPasswordControllerTest extends TestCase
{
    use WithFaker;

    public $email, $pincode;

    protected function setUp() :void
    {
        parent::setUp();

        $this->email = 'mahmoud.mohammed@ivas.com.eg';
    }

    public function test_user_password_reset_send_emails()
    {
        $this->post('api/password/forget', ['email' => $this->email])
                ->assertSessionHasNoErrors()
                ->assertStatus(200)
                ->assertJsonStructure(['success', 'message'])
                ->assertJson(['message' => trans('passwords.sent pincode'), 'success' => true]);

        Mail::fake()->to($this->email)->send(new ForgetPassword(PasswordPinCode::where(['email' => $this->email])->NotExpired()->latest()->first()));
        Mail::assertSent(ForgetPassword::class);
    }

    public function test_user_password_reset()
    {
        $data = [
            'pincode' => PasswordPinCode::where(['email' => $this->email])->NotExpired()->latest()->first()->pincode,
            'email' => $this->email,
            'password' => 'P@$$w0rd',
            'password_confirmation' => 'P@$$w0rd'
        ];

        $this->post('api/password/reset', $data)
                ->assertSessionHasNoErrors()
                ->assertJsonStructure(['success', 'message'])
                ->assertJson(['message' => trans('passwords.reset'), 'success' => true])
                ->assertStatus(200);
    }
}
