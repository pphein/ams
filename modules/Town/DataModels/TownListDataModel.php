<?php

namespace Town\DataModels;

use App\DataModels\BaseDataModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TownListDataModel extends BaseDataModel
{
    public array $data = [];
    public int $count = 0;
    public int $perPage = 0;
    public int $lastPage = 0;
    public int $currentPage = 0;
    public int $total = 0;

    public function __construct(
        private mixed $town
    ) {
        $this->data = $this->parseItems(TownDataModel::class, $town->items());
        $this->count = $town->count();
        $this->perPage = $town->perPage();
        $this->lastPage = $town->lastPage();
        $this->currentPage = $town->currentPage();
        $this->total = $town->total();
    }
}
