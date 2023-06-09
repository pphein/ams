<?php

namespace App\Helpers;

use Illuminate\Http\Response;

class ResponseHelper
{
    public function success($data = []): array
    {
        $response = [
            'status' => Response::HTTP_OK,
            'data' => $data,
            'error' => [
                'message' => ''
            ]
        ];

        return $response;
    }

    public function listSuccess($data): array
    {
        $response = [
            'status' => Response::HTTP_OK,
            'data' => $data->data,
            'count' => $data->count,
            'total' => $data->total,
            'perPage' => $data->perPage,
            'lastPage' => $data->lastPage,
            'currentPage' => $data->currentPage,
            'error' => [
                'message' => ''
            ]
        ];

        return $response;
    }

    public function failed($data, int $status = Response::HTTP_INTERNAL_SERVER_ERROR): array
    {
        $response = [
            'status' => $status,
            'data' => '',
            'error' => [
                'message' => $data
            ]
        ];

        return $response;
    }
}
