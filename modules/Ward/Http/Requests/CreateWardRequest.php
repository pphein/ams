<?php

namespace Ward\Http\Requests;

use App\Http\Requests\BaseRequest;
use Ward\Http\Requests\Rules\CreateWardRequestRules;

class CreateWardRequest extends BaseRequest
{
    public function rules(): array
    {
        return CreateWardRequestRules::rules();
    }
}
