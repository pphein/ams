<?php

namespace District\Http\Requests;

use App\Http\Requests\BaseRequest;
use District\Http\Requests\Rules\UpdateDistrictRequestRules;

class UpdateDistrictRequest extends BaseRequest
{
    public function rules(): array
    {
        return UpdateDistrictRequestRules::rules();
    }
}
