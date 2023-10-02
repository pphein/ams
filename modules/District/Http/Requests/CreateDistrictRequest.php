<?php

namespace District\Http\Requests;

use App\Http\Requests\BaseRequest;
use District\Http\Requests\Rules\CreateDistrictRequestRules;

class CreateDistrictRequest extends BaseRequest
{
    public function rules(): array
    {
        return CreateDistrictRequestRules::rules();
    }
}
