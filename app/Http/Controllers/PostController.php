<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Traits\PostTrait;
use Carbon\Carbon;
use Illuminate\Database\Concerns\ExplainsQueries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PostController extends Controller
{
    use PostTrait;
//    public function index(){
//        return Post::all();
//    }

    public function show($page_number){
        return $this->showPost($page_number);
    }

    public function getPost(Request $request){
        return $this->getThirdPost(env('POST_URL'));
    }


    public function store(Request $request){
        $request->merge(['user_id' => Auth::id(), 'published_at' => Carbon::now()]);
        $this->storePost($request);
        $posts = $this->showUserPost(1);
        return Inertia::render('Posts', ['posts' => $posts]);
    }
}
