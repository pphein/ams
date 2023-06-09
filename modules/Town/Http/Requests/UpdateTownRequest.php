<?php

namespace Town\Http\Requests;

use App\Http\Requests\BaseRequest;
use Town\Http\Requests\Rules\UpdateTownRequestRules;

class UpdateTownRequest extends BaseRequest
{
    public function rules(): array
    {
        return UpdateTownRequestRules::rules();
    }
}
