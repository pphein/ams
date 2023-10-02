<?php

namespace State\Models;

use App\Models\BaseModel;
use State\Contracts\Models\StateInterface;

class State extends BaseModel implements StateInterface
{
    protected $connection = 'main';

    protected $table = 'states';

    protected $fillable = [
        'en_name',
        'mm_name',
        'p_code',
        'country_id',
        'status'
    ];
}
