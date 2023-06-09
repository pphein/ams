<?php

namespace Town\Http\Requests\Rules;

class CreateTownRequestRules
{
    public static function rules()
    {
        return [
            'en_name' => 'required',
            'mm_name' => 'required',
            'p_code' => 'required',
            'township_id' => 'required',
            'district_id' => 'required',
            'city_id' => 'required',
            'state_id' => 'required'
        ];
    }
}
