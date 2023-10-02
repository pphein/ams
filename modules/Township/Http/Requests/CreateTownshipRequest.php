<?php

namespace Township\Http\Requests;

use App\Http\Requests\BaseRequest;
use Township\Http\Requests\Rules\CreateTownshipRequestRules;

class CreateTownshipRequest extends BaseRequest
{
    public function rules(): array
    {
        return CreateTownshipRequestRules::rules();
    }
}
