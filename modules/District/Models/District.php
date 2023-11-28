<?php

namespace District\Models;

use App\Models\BaseModel;
use District\Contracts\Models\DistrictInterface;

class District extends BaseModel implements DistrictInterface
{
    protected $connection = 'main';

    protected $table = 'districts';

    protected $fillable = [
        'en_name',
        'mm_name',
        'p_code',
        'state_id',
        'status'
    ];
}
