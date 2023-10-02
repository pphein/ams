<?php

namespace State\DataModels;

use App\DataModels\BaseDataModel;
use State\Contracts\Models\StateInterface;

class StateDataModel extends BaseDataModel
{
    public int $id = 1;
    public string $en_name = '';
    public string $mm_name = '';
    public string $p_code = '';
    public string $country_code = '';

    public function __construct(
        private ?StateInterface $state
    ) {
        $this->mapProperties($state);
    }
}
