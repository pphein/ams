<?php

namespace State\Http\Requests;

use App\Http\Requests\BaseRequest;
use State\Http\Requests\Rules\UpdateStateRequestRules;

class UpdateStateRequest extends BaseRequest
{
    public function rules(): array
    {
        return UpdateStateRequestRules::rules();
    }
}
