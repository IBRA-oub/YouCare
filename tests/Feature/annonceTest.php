<?php

namespace Tests\Feature;

use App\Models\Annonce;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class annonceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testAnnoceCreated(){
        
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/api/create-annonce', [
            'user_id' => $user->id,
            'titre' => 'titre',
            'description' => 'description',
            'date' => '2000-2-21',
            'location' => 'location',
            'competance' => 'hjk',
            'type_id' => 1,
        ]);

        $response->assertStatus(200);
    }


    public function testUpdateAnnonce()
{
    $user = User::factory()->create();
    
    $announcement = Annonce::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user);

    $response = $this->put('/api/update-annonce/' . $announcement->id, [
        'user_id' => $user->id, 
        'titre' => 'Updated Title',
        'description' => 'Updated Description',
        'date' => '2024-03-27',
        'location' => 'Updated Location',
        'competance' => 'Updated Competence',
        'type_id' => 2,
      
    ]);

    
    $response->assertStatus(200);
}

}