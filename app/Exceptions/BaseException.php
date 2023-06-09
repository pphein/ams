<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response\GrpcFailResponse;
use App\Helpers\Response\RestFailResponse;
use Frontiir\KoreBridge\Exceptions\MicroException;

class BaseException extends Exception
{
    /**
     * Create custom base exception
     *
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct($message);
    }

    /**
     * Render the request
     *
     * @param mixed $request
     * @return array|JsonResponse
     */
    public function render($request): array|JsonResponse
    {
        $class = get_class($request);
        if ($class === \Swoole\Http\Request::class) {
            return $this->renderGrpc();
        }
        return $this->renderRest();
    }

    // /**
    //  * Response for Grpc
    //  *
    //  * @param $status
    //  * @return array
    //  */
    // public function responseGrpc($status): array
    // {
    //     $response = new GrpcFailResponse($this->getMessage(), status: $status);
    //     return response()->toProto(
    //         $response->data,
    //         $response->class,
    //         $response->status
    //     );
    // }

    /**
     * Response for Rest
     *
     * @param $status
     * @return JsonResponse
     */
    public function responseRest($status): JsonResponse
    {
        $response = new RestFailResponse($this->getMessage(), status: $status);
        return response()->json(
            (array) $response,
            $response->status
        );
    }
}
