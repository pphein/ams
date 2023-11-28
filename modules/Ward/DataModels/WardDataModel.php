<?php

namespace Ward\DataModels;

use App\DataModels\BaseDataModel;
use Ward\Contracts\Models\WardInterface;

class WardDataModel extends BaseDataModel
{
    public int $id = 1;
    public string $en_name = '';
    public string $mm_name = '';
    public string $p_code = '';
    public string $town_id = '';
    public string $township_id = '';
    public string $district_id = '';
    public string $city_id = '';
    public string $state_id = '';

    public function __construct(
        private ?WardInterface $ward
    ) {
        $this->mapProperties($ward);
    }
}
