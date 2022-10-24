<?php
namespace App\Traits;

use App\Jobs\PostCacheJob;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

trait PostTrait {

    public function storePost(Request $request): string
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'published_at' => 'required',
            'user_id' => 'required'
        ]);
        PostCacheJob::dispatch($request->all());
        return 'ok';
//        return Post::create($request->all());
    }

    public function showPost(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Post::with(['user'])->orderByDesc('published_at')->paginate();
    }

    public function showUserPost(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $auth_id = Auth::id();
        $page_number = request()->query('page');
        if($page_number == 1 || empty($page_number)){
            return Cache::get('posts_'.$auth_id, function () {
                $user_id = Auth::id();
                $all_posts = Post::with(['user'])->where('user_id', $user_id)->orderByDesc('published_at')->paginate();
                Cache::put('posts_'.$user_id, $all_posts);
                return $all_posts;
            });
        }
        else{
            return Post::with(['user'])->where('user_id', $auth_id)->orderByDesc('published_at')->paginate();
        }
    }

    /**
     * @throws \Exception
     */
    public function getThirdPost(string $url): Response|\Illuminate\Http\JsonResponse|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try{
            $response = Http::get($url);
        }catch (\Exception $e){
            Log::debug("Error: ". json_encode(['status' => $e->getCode(), 'body' => $e->getMessage(), 'url' => $url]));
            return $this->errorResponse($e->getMessage(), 500);
        }

        if($response->clientError() || $response->serverError() || $response->failed()){
            Log::debug("Error: ". json_encode(['status' => $response->status(), 'body' => $response->body(), 'url' => $url]));
            return $this->errorResponse($response->body(), $response->status());
        }

        $value =  json_decode($response);
        $user = User::where('name', 'admin')->first();
        if(empty($user)){
            $user = User::factory()->create();
        }
        $valid_data = [];
        foreach ($value->articles as $post){
//            $article = Post::where('title', $post->title)->first();
//            if(!empty($article)){
//                Log::debug($article);
//                continue;
//            }
//            else {
//                Log::debug('new post');
//            }
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
                array_push($valid_data, $request->all());
            }

        }
        Post::insert($valid_data);
        return $this->successResponse('ok');
    }
}
