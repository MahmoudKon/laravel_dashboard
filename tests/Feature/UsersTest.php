<?php

namespace Tests\Feature;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    public function test_manager_role_users_page()
    {
        $user = User::first();
        $this->actingAs($user)
                ->get("dashboard/users")
                ->assertStatus(200)
                ->assertSeeText(User::count());
    }

    public function test_employee_role_users_page()
    {
        $user = User::latest()->first();
        $this->actingAs($user)
                ->get("dashboard/users")
                ->assertStatus(403)
                ->assertSeeText('You do not have permission to access this page');
    }

    public function test_error_url()
    {
        $user = User::latest()->first();
        $this->actingAs($user)
                ->get("dashboard/error/route")
                ->assertStatus(404)
                ->assertSeeText("This Page Not Found");
    }

    public function test_list_users()
    {
        $user = User::first();
        $this->actingAs($user)
                ->get("dashboard/users", array('HTTP_X-Requested-With' => 'XMLHttpRequest')) // This array is mean the request act as ajax
                ->assertStatus(200)
                ->assertViewIs('backend.includes.tables.table');
    }

    public function test_error_create_user()
    {
        $user = User::first();
        $data = [
            'name' => 'super_admin',
            'password' => '123',
            'email' => 'super_admin@ivas.com',
        ];

        $this->actingAs($user)
                ->post('dashboard/users', $data, array('HTTP_X-Requested-With' => 'XMLHttpRequest'))
                ->assertSessionHasErrors(['email'])
                ->assertStatus(302);
    }

    public function test_create_user()
    {
        $user = User::first();
        $data = [
            'name' => 'test',
            'password' => '123',
            'email' => 'test@ivas.com',
        ];

        $this->actingAs($user)
                ->post('dashboard/users', $data, array('HTTP_X-Requested-With' => 'XMLHttpRequest'))
                ->assertSessionHasNoErrors()
                ->assertStatus(200);
    }

    public function test_user_update_page()
    {
        $user = User::first();
        $this->actingAs($user)
                ->get('dashboard/users/2/edit')
                ->assertStatus(200);
    }

    public function test_error_user_update_page()
    {
        $user = User::first();
        $this->actingAs($user)
                ->get('dashboard/users/200/edit')
                ->assertStatus(500)
                ->assertSee('No query results for model');
    }

    public function test_user_update_error_validation_data()
    {
        $user = User::first();
        $data = [
            'name' => 'test',
            'password' => '123',
            'email' => 'test@ivas.com',
        ];

        $this->actingAs($user)
                ->patch('dashboard/users/2', $data, array('HTTP_X-Requested-With' => 'XMLHttpRequest'))
                ->assertSessionHasErrors(['email'])
                ->assertStatus(302);
    }

    public function test_user_update_data()
    {
        $user = User::first();
        $edit_user = User::find(2);
        $data = [
            'id' => $edit_user->id,
            'name' => 'test',
            'email' => $edit_user->email
        ];

        $this->actingAs($user)
                ->patch('dashboard/users/2', $data, array('HTTP_X-Requested-With' => 'XMLHttpRequest'))
                ->assertSessionHasNoErrors()
                ->assertStatus(200);
    }

    public function test_user_delete()
    {
        $user = User::first();
        $this->actingAs($user)
                ->delete('dashboard/users/3', [], array('HTTP_X-Requested-With' => 'XMLHttpRequest'))
                ->assertSessionHasNoErrors()
                ->assertStatus(200);
    }
}
