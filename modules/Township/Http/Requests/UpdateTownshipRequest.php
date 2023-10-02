<?php

namespace Township\Http\Requests;

use App\Http\Requests\BaseRequest;
use Township\Http\Requests\Rules\UpdateTownshipRequestRules;

class UpdateTownshipRequest extends BaseRequest
{
    public function rules(): array
    {
        return UpdateTownshipRequestRules::rules();
    }
}
