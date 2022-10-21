<?php
namespace App\Traits;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

trait PostTrait {

    public function storePost(Request $request){

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'published_at' => 'required',
            'user_id' => 'required'
        ]);
        return Post::create($request->all());
    }

    public function getThirdPost(){
        $response = Http::get('https://candidate-test.sq1.io/api.phps');
        if($response->clientError()){
            return $response->status();
        }
        if($response->throw()){

        }
    }
}
