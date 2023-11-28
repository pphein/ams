<?php

namespace Township\Services;

use Illuminate\Http\Request;
use App\Helpers\DataSafetyTrait;
use Township\DataModels\TownshipDataModel;
use Illuminate\Database\Eloquent\Collection;
use Township\DataModels\TownshipListDataModel;
use Township\Contracts\Services\TownshipServiceInterface;
use Township\Contracts\Repositories\TownshipRepositoryInterface;

class TownshipService implements TownshipServiceInterface
{
    use DataSafetyTrait;

    public function __construct(
        private TownshipRepositoryInterface $townshipRepo
    ) {
    }
    public function getTownshipLists(Request $request): Collection
    {
        // if (!empty($request->district_id) && !empty($request->city_id)) {
        //     $result = $this->townshipRepo->getTownshipByDistrictAndCity($request);
        //     return new TownshipListDataModel($result);
        // }

        $result = $this->townshipRepo->getTownshipLists();

        return $result;
    }

    public function getTownshipPagination(int $perPage, int $page): TownshipListDataModel
    {
        $result = $this->townshipRepo->getTownshipPagination($perPage, $page);

        return new TownshipListDataModel($result);
    }

    public function createTownship(array $data): TownshipDataModel
    {
        $result = $this->townshipRepo->createTownship($data);

        return new TownshipDataModel($result);
    }

    public function showTownshipById(int $id): TownshipDataModel
    {
        $result = $this->townshipRepo->showTownshipById($id);

        if (!empty($result)) {
            $result = new TownshipDataModel($result);
        }
        return $this->emptyOrThrow($result, 'No pervious saved information');
    }

    public function updateTownshipById(int $id, $data): TownshipDataModel
    {
        $result = $this->townshipRepo->updateTownshipById($id, $data);

        return $this->showTownshipById($id);
    }

    public function destroyTownshipById(int $id): bool
    {
        return $this->townshipRepo->destroyTownshipById($id);
    }

    public function getTownshipByDistrictId(int $id, Request $request): TownshipListDataModel
    {
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        $result = $this->townshipRepo->getTownshipByDistrictId($id, $perPage, $page);

        return new TownshipListDataModel($result);
    }

    public function getTownshipByCityId(int $id, Request $request): TownshipListDataModel
    {
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        $result = $this->townshipRepo->getTownshipByCityId($id, $perPage, $page);

        return new TownshipListDataModel($result);
    }

    public function getTownshipByTownshipshipId(int $id, Request $request): TownshipListDataModel
    {
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        $result = $this->townshipRepo->getTownshipByTownshipshipId($id, $perPage, $page);

        return new TownshipListDataModel($result);
    }
}
