<?php

namespace Township\Repositories;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Township\Contracts\Models\TownshipInterface;
use Township\Contracts\Repositories\TownshipRepositoryInterface;

class TownshipRepository implements TownshipRepositoryInterface
{
    public function __construct(
        private TownshipInterface $township
    ) {
    }

    public function getTownshipLists(): Collection
    {
        return $this->township->where('status', 0)->get();
    }

    public function getTownshipPagination(int $perPage, int $page): mixed
    {
        return $this->township->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function createTownship(array $data): ?TownshipInterface
    {
        return $this->township->create($data);
    }

    public function showTownshipById(int $id): ?TownshipInterface
    {
        return $this->township->where('status', 0)->find($id);
    }

    public function updateTownshipById(int $id, array $data): ?bool
    {
        return $this->township->find($id)?->update($data);
    }

    public function destroyTownshipById(int $id): bool
    {
        return $this->township->find($id)->update([
            'status' => 1
        ]);
    }

    public function getTownshipByDistrictId(int $districtId, int $perPage, int $page): mixed
    {
        return $this->township->where('District_id', $districtId)->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function getTownshipByCityId(int $cityId, int $perPage, int $page): mixed
    {
        return $this->township->where('city_id', $cityId)->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function getTownshipByStateId(int $stateId, int $perPage, int $page): mixed
    {
        return $this->township->where('state_id', $stateId)->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function getTownshipByDistrictAndCity(Request $request)
    {
        $cityId = $request->city_id;
        $districtId = $request->district_id;
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        return $this->township
            ->where('city_id', $cityId)
            ->where('district', $districtId)
            ->where('status', 0)->paginate(perPage: $perPage, page: $page);
    }

    public function getTownshipByNameAndPCode(string $name, string $PCode): ?TownshipInterface
    {
        return $this->township->where('en_name', $name)->where('p_code', $PCode)->where('status', 0)->first();
    }
}
