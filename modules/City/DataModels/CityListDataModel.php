<?php

namespace City\DataModels;

use App\DataModels\BaseDataModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CityListDataModel extends BaseDataModel
{
    public array $data = [];
    public int $count = 0;
    public int $perPage = 0;
    public int $lastPage = 0;
    public int $currentPage = 0;
    public int $total = 0;

    public function __construct(
        private mixed $city
    ) {
        $this->data = $this->parseItems(CityDataModel::class, $city->items());
        $this->count = $city->count();
        $this->perPage = $city->perPage();
        $this->lastPage = $city->lastPage();
        $this->currentPage = $city->currentPage();
        $this->total = $city->total();
    }
}
