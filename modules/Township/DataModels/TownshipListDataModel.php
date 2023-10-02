<?php

namespace Township\DataModels;

use App\DataModels\BaseDataModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TownshipListDataModel extends BaseDataModel
{
    public array $data = [];
    public int $count = 0;
    public int $perPage = 0;
    public int $lastPage = 0;
    public int $currentPage = 0;
    public int $total = 0;

    public function __construct(
        private mixed $township
    ) {
        $this->data = $this->parseItems(TownshipDataModel::class, $township->items());
        $this->count = $township->count();
        $this->perPage = $township->perPage();
        $this->lastPage = $township->lastPage();
        $this->currentPage = $township->currentPage();
        $this->total = $township->total();
    }
}
