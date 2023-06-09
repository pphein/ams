<?php

namespace App\Helpers\Response;

class RestFailResponse
{
    public int $status;
    public array $data = [];
    public array $error;

    public function __construct(
        string $message,
        int $status = 500
    ) {
        $this->status = $status;
        $this->error = [
            'message' => $message
        ];
    }
}
