<?php

namespace District\Http\Requests\Rules;

class CreateDistrictRequestRules
{
    public static function rules()
    {
        return [
            'en_name' => 'required',
            'mm_name' => 'required',
            'p_code' => 'required',
            'state_id' => 'required',
            'country_id' => 'required'
        ];
    }
}
