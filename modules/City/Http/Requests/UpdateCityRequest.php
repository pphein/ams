<?php

namespace City\Http\Requests;

use App\Http\Requests\BaseRequest;
use City\Http\Requests\Rules\UpdateCityRequestRules;

class UpdateCityRequest extends BaseRequest
{
    public function rules(): array
    {
        return UpdateCityRequestRules::rules();
    }
}
