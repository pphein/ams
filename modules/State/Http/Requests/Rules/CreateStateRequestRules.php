<?php

namespace State\Http\Requests\Rules;

class CreateStateRequestRules
{
    public static function rules()
    {
        return [
            'en_name' => 'required',
            'mm_name' => 'required',
            'p_code' => 'required',
            'country_id' => 'required'
        ];
    }
}
