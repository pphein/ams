<?php

namespace Ward\DataModels;

use App\DataModels\BaseDataModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class WardListDataModel extends BaseDataModel
{
    public array $data = [];
    public int $count = 0;
    public int $perPage = 0;
    public int $lastPage = 0;
    public int $currentPage = 0;
    public int $total = 0;

    public function __construct(
        private mixed $ward
    ) {
        $this->data = $this->parseItems(WardDataModel::class, $ward->items());
        $this->count = $ward->count();
        $this->perPage = $ward->perPage();
        $this->lastPage = $ward->lastPage();
        $this->currentPage = $ward->currentPage();
        $this->total = $ward->total();
    }
}
