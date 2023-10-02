<?php

namespace Town\Repositories;

use Illuminate\Http\Request;
use Town\Contracts\Models\TownInterface;
use Town\Contracts\Repositories\TownRepositoryInterface;

class TownRepository implements TownRepositoryInterface
{
    public function __construct(
        private TownInterface $town
    ) {
    }

    public function getTownLists(int $perPage, int $page): mixed
    {
        return $this->town->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function createTown(array $data): ?TownInterface
    {
        return $this->town->create($data);
    }

    public function showTownById(int $id): ?TownInterface
    {
        return $this->town->where('status', 0)->find($id);
    }

    public function updateTownById(int $id, array $data): ?bool
    {
        return $this->town->find($id)?->update($data);
    }

    public function destroyTownById(int $id): bool
    {
        return $this->town->find($id)->update([
            'status' => 1
        ]);
    }

    public function getTownByDistrictId(int $districtId, int $perPage, int $page): mixed
    {
        return $this->town->where('District_id', $districtId)->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function getTownByCityId(int $cityId, int $perPage, int $page): mixed
    {
        return $this->town->where('city_id', $cityId)->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function getTownByTownshipId(int $cityId, int $perPage, int $page): mixed
    {
        return $this->town->where('township_id', $cityId)->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function getTownByDistrictAndCity(Request $request)
    {
        $cityId = $request->city_id;
        $districtId = $request->district_id;
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        return $this->town
            ->where('city_id', $cityId)
            ->where('district', $districtId)
            ->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }
}
