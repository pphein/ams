<?php

namespace District\DataModels;

use App\DataModels\BaseDataModel;
use District\Contracts\Models\DistrictInterface;

class DistrictDataModel extends BaseDataModel
{
    public int $id = 1;
    public string $en_name = '';
    public string $mm_name = '';
    public string $p_code = '';
    public string $state_id = '';
    public string $country_code = '';

    public function __construct(
        private ?DistrictInterface $district
    ) {
        $this->mapProperties($district);
    }
}
