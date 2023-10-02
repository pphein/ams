<?php

namespace City\Http\Requests;

use App\Http\Requests\BaseRequest;
use City\Http\Requests\Rules\CreateCityRequestRules;

class CreateCityRequest extends BaseRequest
{
    public function rules(): array
    {
        return CreateCityRequestRules::rules();
    }
}
