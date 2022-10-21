<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(){
        return Post::all();
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'published_at' => 'required',
        ]);

        $user = Auth::user();
        return $user->post()->create($request->all());
    }
}
