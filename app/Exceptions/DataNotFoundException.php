<?php

namespace App\Exceptions;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Frontiir\KoreBridge\Constants\GrpcResponse;

class DataNotFoundException extends BaseException
{
    public function __construct($message)
    {
        parent::__construct($message);
    }

    // public function renderGrpc(): array
    // {
    //     return $this->responseGrpc(GrpcResponse::NOT_FOUND());
    // }

    public function renderRest(): JsonResponse
    {
        return $this->responseRest(Response::HTTP_NOT_FOUND);
    }
}
