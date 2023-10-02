<?php

namespace District\DataModels;

use App\DataModels\BaseDataModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DistrictListDataModel extends BaseDataModel
{
    public array $data = [];
    public int $count = 0;
    public int $perPage = 0;
    public int $lastPage = 0;
    public int $currentPage = 0;
    public int $total = 0;

    public function __construct(
        private mixed $district
    ) {
        $this->data = $this->parseItems(DistrictDataModel::class, $district->items());
        $this->count = $district->count();
        $this->perPage = $district->perPage();
        $this->lastPage = $district->lastPage();
        $this->currentPage = $district->currentPage();
        $this->total = $district->total();
    }
}
