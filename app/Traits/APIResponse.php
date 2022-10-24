<?php
namespace App\Traits;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Response;

trait APIResponse {
    /**
     * @param $data
     * @param int $code
     * @return Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function successResponse(mixed $data, int $code = Response::HTTP_OK): Response|Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return response(['data' => $data, 'code' => $code])->header('Content-Type', 'application/json');
    }

    /**
     * @param string $message
     * @param int $code
     * @return Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|Response
     */
    public function errorResponse(string $message, int $code): Response|\Illuminate\Http\JsonResponse|Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return response(['message' => $message, 'code' => $code], $code);
    }

    /**
     * @param string $message
     * @param int $code
     * @return Response|\Illuminate\Http\JsonResponse|Application|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function errorMessage(string $message, int $code): Response|\Illuminate\Http\JsonResponse|Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return response($message, $code);
    }

    public function errorClient(string $message, int $code): Response|Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return response($message, $code)->header('Content-Type', 'application/json');
    }


}
