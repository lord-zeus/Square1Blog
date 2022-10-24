<?php
namespace App\Traits;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Response;

trait APIResponse {
    /**
     * @param $data
     * @param int $code
     * @return Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     *
     */
    public function successResponse($data, int $code = Response::HTTP_OK){
        return response(['data' => $data, 'code' => $code])->header('Content-Type', 'application/json');
    }

    /**
     * @param $message
     * @param $code
     * @return Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|Response
     *
     */
    public function errorResponse($message, $code){
        return response(['message' => $message, 'code' => $code], $code);
    }

    /**
     * @param $message
     * @param $code
     * @return Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|Response
     *
     */
    public function errorMessage($message, $code){
        return response($message, $code);
    }

    public function errorClient($message, $code){
        return response($message, $code)->header('Content-Type', 'application/json');
    }


}
