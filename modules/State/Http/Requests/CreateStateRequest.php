<?php

namespace State\Http\Requests;

use App\Http\Requests\BaseRequest;
use State\Http\Requests\Rules\CreateStateRequestRules;

class CreateStateRequest extends BaseRequest
{
    public function rules(): array
    {
        return CreateStateRequestRules::rules();
    }
}
