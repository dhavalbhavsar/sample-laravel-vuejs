<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Modules\Posts\Http\Models\Post;

class PostsTest extends TestCase
{
	use RefreshDatabase;

    public function test_post_screen_can_be_rendered()
    {
    	$this->actingAs(User::factory()->create());

        $response = $this->get('/posts');

        $response->assertStatus(200);
    }

    public function test_new_post_can_store()
    {
    	$this->actingAs(User::factory()->create());

        $response = $this->post('/post/create', [
            'title' => 'Sample Post',
            'body' => 'Sample Post',
        ]);

        $response->assertRedirect('/posts');
    }

    
    public function test_new_post_can_update()
    {
    	$this->actingAs(User::factory()->create());

    	$post = factory(Post::class)->create();

        $response = $this->put('/post/update/'.$post->id, [
        	'id' => $post->id,
            'title' => 'Sample Post Update',
            'body' => 'Sample Post Update',
        ]);

        $response->assertRedirect('/posts');
    }

	
    public function test_new_post_can_delete()
    {
    	$this->actingAs(User::factory()->create());

    	$post = factory(Post::class)->create();

        $response = $this->delete('/post/destroy/'.$post->id, [
        	'id' => $post->id
        ]);

        $response->assertRedirect('/posts');
    }
    
}
