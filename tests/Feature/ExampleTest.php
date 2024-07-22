<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Camera;

class CameraTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_camera()
    {
        $response = $this->postJson('/api/cameras', [
            'name' => 'Camera 1',
            'description' => 'Description 1',
            'address' => 'Address 1',
            'latitude' => 12.345678,
            'longitude' => 98.765432,
        ], ['Authorization' => 'Bearer your_static_token_here']);

        $response->assertStatus(201);
    }

    public function test_read_camera()
    {
        $camera = Camera::factory()->create();

        $response = $this->getJson('/api/cameras/'.$camera->id, [], ['Authorization' => 'Bearer your_static_token_here']);

        $response->assertStatus(200);
    }

    public function test_update_camera()
    {
        $camera = Camera::factory()->create();

        $response = $this->putJson('/api/cameras/'.$camera->id, [
            'name' => 'Updated Camera',
            'description' => 'Updated Description',
            'address' => 'Updated Address',
            'latitude' => 12.345678,
            'longitude' => 98.765432,
        ], ['Authorization' => 'Bearer your_static_token_here']);

        $response->assertStatus(200);
    }

    public function test_delete_camera()
    {
        $camera = Camera::factory()->create();

        $response = $this->deleteJson('/api/cameras/'.$camera->id, [], ['Authorization' => 'Bearer your_static_token_here']);

        $response->assertStatus(204);
    }
}
