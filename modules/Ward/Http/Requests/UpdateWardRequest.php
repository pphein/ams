<?php

namespace Ward\Http\Requests;

use App\Http\Requests\BaseRequest;
use Ward\Http\Requests\Rules\UpdateWardRequestRules;

class UpdateWardRequest extends BaseRequest
{
    public function rules(): array
    {
        return UpdateWardRequestRules::rules();
    }
}
