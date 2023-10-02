<?php

namespace Town\Models;

use App\Models\BaseModel;
use Town\Contracts\Models\TownInterface;

class Town extends BaseModel implements TownInterface
{
    protected $connection = 'main';

    protected $table = 'towns';

    protected $fillable = [
        'en_name',
        'mm_name',
        'p_code',
        'township_id',
        'district_id',
        'city_id',
        'District_id',
        // 'country_id',
        'status'
    ];
}
