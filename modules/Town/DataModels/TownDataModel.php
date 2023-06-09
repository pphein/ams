<?php

namespace Town\DataModels;

use App\DataModels\BaseDataModel;
use Town\Contracts\Models\TownInterface;

class TownDataModel extends BaseDataModel
{
    public int $id = 1;
    public string $en_name = '';
    public string $mm_name = '';
    public string $p_code = '';
    public string $township_id = '';
    public string $district_id = '';
    public string $city_id = '';
    public string $state_id = '';
    public string $country_code = '';

    public function __construct(
        private ?TownInterface $state
    ) {
        $this->mapProperties($state);
    }
}
