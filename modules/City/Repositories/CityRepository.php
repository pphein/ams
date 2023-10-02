<?php

namespace City\Repositories;

use Illuminate\Http\Request;
use City\Contracts\Models\CityInterface;
use City\Contracts\Repositories\CityRepositoryInterface;

class CityRepository implements CityRepositoryInterface
{
    public function __construct(
        private CityInterface $city
    ) {
    }

    public function getCityLists(int $perPage, int $page): mixed
    {
        return $this->city->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function createCity(array $data): ?CityInterface
    {
        return $this->city->create($data);
    }

    public function showCityById(int $id): ?CityInterface
    {
        return $this->city->where('status', 0)->find($id);
    }

    public function updateCityById(int $id, array $data): ?bool
    {
        return $this->city->find($id)?->update($data);
    }

    public function destroyCityById(int $id): bool
    {
        return $this->city->find($id)->update([
            'status' => 1
        ]);
    }

    public function getCityByStateId(int $stateId, int $perPage, int $page): mixed
    {
        return $this->city->where('City_id', $stateId)->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function getCityByCountryId(int $countryId, int $perPage, int $page): mixed
    {
        return $this->city->where('City_id', $countryId)->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function getCityByStateAndCountry(Request $request)
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
