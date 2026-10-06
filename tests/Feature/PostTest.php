<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_post(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
                         ->postJson('/api/posts', [
                             'title' => 'Test Post Title',
                             'content' => 'This is the body content of the test post.',
                         ]);

        $response->assertStatus(201)
                 ->assertJsonPath('title', 'Test Post Title');

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post Title',
        ]);
    }

    public function test_can_list_paginated_posts(): void
    {
        $user = User::factory()->create();
        Post::factory()->count(15)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'sanctum')
                        ->getJson('/api/posts');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data',
                    'links',
                    'current_page',
                    'total',
                    'per_page',
                ]);
    }
}
