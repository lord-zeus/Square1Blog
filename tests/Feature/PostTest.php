<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;
use App\Models\User;
use App\Traits\APIResponse;
use App\Traits\PostTrait;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class PostTest extends TestCase
{
    use DatabaseMigrations, PostTrait, APIResponse;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_visitors_can_view_posts()
    {
        User::factory()->create();
        Post::factory(50)->create();
        $response = $this->get('/posts');

        $response->assertStatus(200);
        $response->assertSee('admin');

    }

    public function test_get_paginated_post(){
        User::factory()->create();
        Post::factory(50)->create();

        $post = $this->showPost();

        $this->assertNotEmpty($post);

    }

    public function test_post_can_store_if_fields_are_lacking(){
        $request = New Request([
            'title' => null
        ]);

        try{
            $this->storePost($request);
        }catch (\Exception $exception){
            Log::debug($exception->getMessage());
            $this->assertNotEmpty($exception->getMessage());
            $this->assertStringContainsString('title field is', $exception->getMessage());
        } finally {
            $post = Post::all();
            $this->assertEmpty($post);
        }

    }

    public function test_get_post_from_other_server_and_store(){
        $response  = $this->getThirdPost(env('POST_URL'));
        $this->assertJson(json_encode(['data' => 'ok', 'code' => '200']), $response);
    }

    public function test_get_proper_exception_if_request_fails(){
        $url = 'https://candidate-test.sq1.io/api.phps';
        $posts = $this->getThirdPost($url);
        $this->assertNotEquals(200, $posts->getStatusCode());
    }
}
