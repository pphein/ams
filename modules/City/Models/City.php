<?php

namespace City\Models;

use App\Models\BaseModel;
use City\Contracts\Models\CityInterface;

class City extends BaseModel implements CityInterface
{
    protected $connection = 'main';

    protected $table = 'cities';

    protected $fillable = [
        'en_name',
        'mm_name',
        'p_code',
        'state_id',
        'status'
    ];
}
