<?php

namespace Township\Models;

use App\Models\BaseModel;
use Township\Contracts\Models\TownshipInterface;

class Township extends BaseModel implements TownshipInterface
{
    protected $connection = 'main';

    protected $table = 'townships';

    protected $fillable = [
        'en_name',
        'mm_name',
        'p_code',
        'district_id',
        'city_id',
        'state_id',
        'country_id',
        'status'
    ];
}
