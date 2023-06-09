<?php

namespace App\Helpers;

use App\Exceptions\DataNotFoundException;

trait DataSafetyTrait
{
    public function emptyOrThrow($data, string $message = 'D')
    {
        return empty($data)
            ? throw new DataNotFoundException($message)
            : $data;
    }
}
