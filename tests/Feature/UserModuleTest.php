<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserModuleTest extends TestCase
{
    
    use RefreshDatabase;


    /**
     * @test
     */
    function it_can_register_user()
    {

        $response = $this->post('/api/v1/auth/register',[
            'name' => 'Edwin Zapata',
            'email'=> 'edwinrzc@gmail.com',
            'password' => 'admin0000',
            'password_confirmation'=>'admin0000'
        ]);

        $response->assertStatus(201);
    }

    /**
     * @test
     */
    function it_can_logger_user()
    {

        $this->artisan('passport:install');

        $user = User::factory()->create([
            'password'=>Hash::make('admin0000'),
        ]);


        $response = $this->post('/api/v1/auth/login',[
            'email'=> $user->email,
            'password' => 'admin0000',
        ]);

        $response->assertStatus(201);

    }

    /**
     * @test
     */
    function must_be_a_valid_email()
    {

        $response = $this->post('/api/v1/auth/register',[
            'name' => 'Edwin Zapata',
            'email'=> 'edwinrzc',
            'password' => 'admin0000',
            'password_confirmation'=>'admin0000'
        ]);


        $response->assertStatus(500)
        ->assertJsonMissingValidationErrors('errors');

    }
}
