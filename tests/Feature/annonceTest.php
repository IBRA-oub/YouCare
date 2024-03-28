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
            'competance' => 'hjk,hjk,pp',
            'type_id' => 1,
        ]);

        $response->assertStatus(200);
    }


    public function testUpdateAnnonce()
{
    $user = User::factory()->create();
    
    $this->actingAs($user);
    
        $announcement = Annonce::create([
        'user_id' => $user->id, 
        'titre' => 'Updated Title',
        'description' => 'Updated Description',
        'date' => '2024-03-27',
        'location' => 'Updated Location',
        'competance' => 'Updated Competence',
        'type_id' => 1,
    ]);


    $response = $this->put('/api/update-annonce/' . $announcement->id, [
        'user_id' => $user->id, 
        'titre' => 'Updated Titlehhhhhhhhhh',
        'description' => 'Updated Descriptionhhhhhhh',
        'date' => '2024-03-11',
        'location' => 'Updated Locationhhhhhh',
        'competance' => 'Updated Competencehhhhhh',
        'type_id' => 1,
      
    ]);

    
    $response->assertStatus(200);
}


public function testDeleteAnnonce()
{
    $user = User::factory()->create();
    
    $this->actingAs($user);
    
        $announcement = Annonce::create([
        'user_id' => $user->id, 
        'titre' => 'Updated Title',
        'description' => 'Updated Description',
        'date' => '2024-03-27',
        'location' => 'Updated Location',
        'competance' => 'Updated Competence',
        'type_id' => 1,
    ]);


    $response = $this->delete('/api/delete-annonce/' . $announcement->id, [
      
    ]);

    
    $response->assertStatus(200);
}

}