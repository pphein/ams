<?php

namespace State\Repositories;

use Illuminate\Http\Request;
use State\Contracts\Models\StateInterface;
use Illuminate\Database\Eloquent\Collection;
use State\Contracts\Repositories\StateRepositoryInterface;

class StateRepository implements StateRepositoryInterface
{
    public function __construct(
        private StateInterface $state
    ) {
    }

    public function getStatePagination(int $perPage, int $page): mixed
    {
        return $this->state->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function getStateLists(): Collection
    {
        return $this->state->where('status', 0)->get();
    }

    public function firstOrCreateState(array $data): ?StateInterface
    {
        return $this->state->firstOrCreate($data);
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
        return $this->state->where('country_id', $countryId)->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function getStateByNameAndPCode(string $stateName, string $statePcode): ?StateInterface
    {
        return $this->state->where('p_code', $statePcode)->where('en_name', $stateName)->first();
    }
}
