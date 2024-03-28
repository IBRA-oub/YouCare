<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class authTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testRegister(){
        
        $response = $this->post('/api/register', [
           'name' => 'brahim',
           'email' => 'yassine3@example.com',
           'password' => 'brahim123',
           'password_confirmation' => 'brahim123',
           'role' => 'organisateur',
        ]);

        $response->assertStatus(200);
    }
    
    public function testLogin(){

        $response = $this->post('/api/login' , [
            'email' => 'yassine3@example.com',
            'password' =>'brahim123',
        ]);
        $response->assertStatus(200);
        
    }

    // public function testLougout(){

    //     $response = $this->post('/api/logout');
    //     $response->assertStatus(200);
        
    // }
}