<?php

namespace State\Repositories;

use Illuminate\Http\Request;
use State\Contracts\Models\StateInterface;
use State\Contracts\Repositories\StateRepositoryInterface;

class StateRepository implements StateRepositoryInterface
{
    public function __construct(
        private StateInterface $state
    ) {
    }

    public function getStateLists(int $perPage, int $page): mixed
    {
        return $this->state->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function createState(array $data): ?StateInterface
    {
        return $this->state->create($data);
    }

    public function showStateById(int $id): ?StateInterface
    {
        return $this->state->where('status', 0)->find($id);
    }

    public function updateStateById(int $id, array $data): ?bool
    {
        return $this->state->find($id)?->update($data);
    }

    public function destroyStateById(int $id): bool
    {
        return $this->state->find($id)->update([
            'status' => 1
        ]);
    }

    public function getStateByCountryId(int $countryId, int $perPage, int $page): mixed
    {
        return $this->state->where('State_id', $countryId)->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }
}
