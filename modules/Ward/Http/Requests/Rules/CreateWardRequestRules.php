<?php

namespace Ward\Http\Requests\Rules;

class CreateWardRequestRules
{
    public static function rules()
    {
        return [
            'en_name' => 'required',
            'mm_name' => 'required',
            'p_code' => 'required',
            'town_id' => 'required',
            'township_id' => 'required',
            'district_id' => 'required',
            'city_id' => 'required',
            'state_id' => 'required'
        ];
    }
}
