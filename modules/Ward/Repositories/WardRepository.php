<?php

namespace Ward\Repositories;

use Illuminate\Http\Request;
use Ward\Contracts\Models\WardInterface;
use Illuminate\Database\Eloquent\Collection;
use Ward\Contracts\Repositories\WardRepositoryInterface;

class WardRepository implements WardRepositoryInterface
{
    public function __construct(
        private WardInterface $ward
    ) {
    }

    public function getWardLists(): Collection
    {
        return $this->ward->where('status', 0)->get();
    }

    public function getWardPagination(int $perPage, int $page): mixed
    {
        return $this->ward->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function firstOrCreateWard(array $data): ?WardInterface
    {
        return $this->ward->firstOrCreate($data);
    }

    public function showWardById(int $id): ?WardInterface
    {
        return $this->ward->where('status', 0)->find($id);
    }

    public function updateWardById(int $id, array $data): ?bool
    {
        return $this->ward->find($id)?->update($data);
    }

    public function destroyWardById(int $id): bool
    {
        return $this->ward->find($id)->update([
            'status' => 1
        ]);
    }

    public function getWardByDistrictId(int $districtId, int $perPage, int $page): mixed
    {
        return $this->ward->where('District_id', $districtId)->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function getWardByCityId(int $cityId, int $perPage, int $page): mixed
    {
        return $this->ward->where('city_id', $cityId)->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function getWardByTownshipId(int $townshipId, int $perPage, int $page): mixed
    {
        return $this->ward->where('township_id', $townshipId)->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function getWardByTownId(int $townId, int $perPage, int $page): mixed
    {
        return $this->ward->where('town_id', $townId)->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function getWardByDistrictAndCity(Request $request)
    {
        $cityId = $request->city_id;
        $districtId = $request->district_id;
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        return $this->ward
            ->where('city_id', $cityId)
            ->where('district', $districtId)
            ->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }
}
