<?php

namespace Township\Http\Requests\Rules;

class UpdateTownshipRequestRules
{
    public static function rules()
    {
        return [
            'en_name' => 'required',
            'mm_name' => 'required',
            'p_code' => 'required',
            'district_id' => 'required',
            'city_id' => 'required',
            'state_id' => 'required',
            'country_id' => 'required'
        ];
    }
}
