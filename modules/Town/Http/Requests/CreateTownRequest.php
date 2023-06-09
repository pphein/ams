<?php

namespace Town\Http\Requests;

use App\Http\Requests\BaseRequest;
use Town\Http\Requests\Rules\CreateTownRequestRules;

class CreateTownRequest extends BaseRequest
{
    public function rules(): array
    {
        return CreateTownRequestRules::rules();
    }
}
