<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Traits\APIResponse;
use App\Traits\PostTrait;
use Carbon\Carbon;
use Illuminate\Database\Concerns\ExplainsQueries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class PostController extends Controller
{
    use PostTrait, APIResponse;
//    public function index(){
//        return Post::all();
//    }

    public function show(){
        $posts =  $this->showPost();
        return Inertia::render('Posts', ['posts' => $posts]);
    }

    public function showAuthPost(){
        $posts = $this->showUserPost();
        return Inertia::render('Posts', ['posts' => $posts]);
    }

    public function getPost(Request $request){
        return $this->getThirdPost(env('POST_URL'));
    }


    public function store(Request $request){
        $user_id = Auth::id();
        $request->merge(['user_id' => $user_id, 'published_at' => Carbon::now()]);
        $this->storePost($request);
        Cache::put('posts_'. $user_id, 0, 0);
        $posts = $this->showUserPost();
        return Inertia::render('Posts', ['posts' => $posts]);
    }
}
