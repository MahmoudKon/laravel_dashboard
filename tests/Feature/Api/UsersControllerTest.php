<?php

namespace Tests\Feature\Api;

use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    public $route, $model, $key;

    protected function setUp() :void
    {
        parent::setUp();

        $this->model   = User::class;
        $this->route   = 'users';
        $this->key     = 'user';
        Passport::actingAs(User::first());
    }

    public function test_api_index()
    {
        $count = $this->model::count() - 1;
        $last_page = (int) ceil($count / 10);
        $this->get("api/$this->route", [], ['Accept' => 'application/json'])
                ->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        [
                            'id',
                            'name'
                        ]
                    ],
                    'meta' => [
                        'current_page',
                        'last_page'
                    ]
                ])
                ->assertJson(['meta' => ['last_page' => $last_page, 'total' => $count]])
                ->assertJsonCount($count, 'data');
    }

    public function test_api_store()
    {
        $data = [
            "name" => "Test New User",
            'email' => 'new_test_email@app.com',
            'password' => '123',
            'department_id' => Department::first()->id,
        ];

        $this->post("api/$this->route", $data, ['Accept' => 'application/json'])
                ->assertSessionHasNoErrors()
                ->assertStatus(200)
                ->assertJsonStructure([
                    $this->key => [
                        'id',
                        'name',
                        'email'
                    ]
                ])
                ->assertJson([$this->key => ['name' => $data['name']]])
                ->assertJson(['message' => trans('flash.row created', ['model' => trans('menu.user')])]);
    }

    public function test_api_update()
    {
        $row = $this->model::where('email', 'new_test_email@app.com')->first();
        $data = $row->toArray();
        $data['name'] = 'Update name';

        $this->put("api/$this->route/$row->id", $data, ['Accept' => 'application/json'])
                ->assertSessionHasNoErrors()
                ->assertStatus(200)
                ->assertJsonStructure([
                    $this->key => [
                        'id',
                        'name',
                        'email'
                    ]
                ])
                ->assertJson([$this->key => ['name' => $data['name']]])
                ->assertJson(['message' => trans('flash.row updated', ['model' => trans('menu.user')])]);
    }

    public function test_api_destroy()
    {
        $row = $this->model::where('email', 'new_test_email@app.com')->first();

        $this->delete("api/$this->route/$row->id", [], ['Accept' => 'application/json'])
                ->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'message',
                ])
                ->assertJson(['message' => trans('flash.row deleted', ['model' => trans('menu.user')])])
                ->assertJson(['success' => true]);
    }
}
