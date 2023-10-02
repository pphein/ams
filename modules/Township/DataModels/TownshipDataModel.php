<?php

namespace Township\DataModels;

use App\DataModels\BaseDataModel;
use Township\Contracts\Models\TownshipInterface;

class TownshipDataModel extends BaseDataModel
{
    public int $id = 1;
    public string $en_name = '';
    public string $mm_name = '';
    public string $p_code = '';
    public string $district_id = '';
    public string $city_id = '';
    public string $state_id = '';
    public string $country_code = '';

    public function __construct(
        private ?TownshipInterface $township
    ) {
        $this->mapProperties($township);
    }
}
