<?php

namespace Ward\Models;

use App\Models\BaseModel;
use Ward\Contracts\Models\WardInterface;

class Ward extends BaseModel implements WardInterface
{
    protected $connection = 'main';

    protected $table = 'wards';

    protected $fillable = [
        'en_name',
        'mm_name',
        'p_code',
        'town_id',
        'township_id',
        'district_id',
        'city_id',
        'state_id',
        'status'
    ];
}
