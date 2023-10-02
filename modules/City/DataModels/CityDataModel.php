<?php

namespace City\DataModels;

use App\DataModels\BaseDataModel;
use City\Contracts\Models\CityInterface;

class CityDataModel extends BaseDataModel
{
    public int $id = 1;
    public string $en_name = '';
    public string $mm_name = '';
    public string $p_code = '';
    public string $state_id = '';
    public string $country_code = '';

    public function __construct(
        private ?CityInterface $city
    ) {
        $this->mapProperties($city);
    }
}
