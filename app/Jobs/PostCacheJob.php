<?php

namespace App\Jobs;

use App\Models\Post;
use App\Traits\PostTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PostCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, PostTrait;

    /**
     * Create a new job instance.
     *
     * @param $data
     */
    public function __construct(public $data){}


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Post::create($this->data);
        Cache::put('posts_'. $this->data['user_id'], 0, 0);
        $all_posts = Post::with(['user'])->where('user_id', $this->data['user_id'])->orderByDesc('published_at')->paginate();
        Cache::put('posts_'.$this->data['user_id'], $all_posts);
    }
}
