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
        private mixed $state
    ) {
        $this->data = $this->parseItems(TownDataModel::class, $state->items());
        $this->count = $state->count();
        $this->perPage = $state->perPage();
        $this->lastPage = $state->lastPage();
        $this->currentPage = $state->currentPage();
        $this->total = $state->total();
    }
}
