<?php

namespace District\Repositories;

use Illuminate\Http\Request;
use District\Contracts\Models\DistrictInterface;
use District\Contracts\Repositories\DistrictRepositoryInterface;

class DistrictRepository implements DistrictRepositoryInterface
{
    public function __construct(
        private DistrictInterface $district
    ) {
    }

    public function getDistrictLists(int $perPage, int $page): mixed
    {
        return $this->district->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function createDistrict(array $data): ?DistrictInterface
    {
        return $this->district->create($data);
    }

    public function showDistrictById(int $id): ?DistrictInterface
    {
        return $this->district->where('status', 0)->find($id);
    }

    public function updateDistrictById(int $id, array $data): ?bool
    {
        return $this->district->find($id)?->update($data);
    }

    public function destroyDistrictById(int $id): bool
    {
        return $this->district->find($id)->update([
            'status' => 1
        ]);
    }

    public function getDistrictByStateId(int $stateId, int $perPage, int $page): mixed
    {
        return $this->district->where('district_id', $stateId)->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function getDistrictByCountryId(int $countryId, int $perPage, int $page): mixed
    {
        return $this->district->where('district_id', $countryId)->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function getDistrictByStateAndCountry(Request $request)
    {
        $stateId = $request->state_id;
        $countryId = $request->country_id;
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        return $this->town
            ->where('state_id', $stateId)
            ->where('country', $countryId)
            ->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }
}
