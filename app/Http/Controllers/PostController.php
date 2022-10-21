<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Traits\PostTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PostController extends Controller
{
    use PostTrait;
    public function index(){
        return Post::all();
    }

    public function showPost($page_number){
        return $posts =  Post::with(['user'])->orderByDesc('created_at')->paginate(20);
        return Inertia::render('Posts', ['posts' => $posts]);
    }

    public function getPost(Request $request){
        return $this->getThirdPost();
    }


    public function store(Request $request){
        $request->merge(['user_id' => Auth::id(), 'published_at' => Carbon::now()]);
        $this->storePost($request);
        $posts = $this->showPost(1);
        return Inertia::render('Posts', ['posts' => $posts]);
    }
}
