<?php
namespace App\Traits;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

trait PostTrait {

    public function storePost(Request $request){

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'published_at' => 'required',
            'user_id' => 'required'
        ]);

//        Log::debug($validation);
        return Post::create($request->all());
    }

    public function getThirdPost(){
        $url = 'https://candidate-test.sq1.io/api.php';
        try{
            $response = Http::get($url);
        }catch (\Exception $e){
            Log::debug("Error: ". json_encode(['status' => $e->getCode(), 'body' => $e->getMessage(), 'url' => $url]));
            return 'Error';
        }

        if($response->clientError() || $response->serverError() || $response->failed()){
            Log::debug("Error: ". json_encode(['status' => $response->status(), 'body' => $response->body(), 'url' => 'https://candidate-test.sq1.io/api.phps']));
            return 'Error';
        }

        $value =  json_decode($response);
        $user = User::where('name', 'admin')->first();
        if(empty($user)){
            $user = User::factory()->create();
        }

        foreach ($value->articles as $post){
            $request = new Request(['user_id' => $user->id, 'title' => $post->title, 'description' => $post->description, 'published_at' => $post->publishedAt]);
            $validation = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'published_at' => 'required',
                'user_id' => 'required'
            ]);
            if(count($validation->errors()) > 0){
                Log::debug("Error: " . json_encode(['status' => '422', 'body' => $validation->errors(), 'data' => $request->all(), 'url' =>$url]));
            }
            else {
               $this->storePost($request);
            }

        }
        return 'ok';
    }
}
