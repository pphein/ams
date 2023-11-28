<?php

namespace Town\Services;

use Illuminate\Http\Request;
use App\Helpers\DataSafetyTrait;
use Town\DataModels\TownDataModel;
use Town\DataModels\TownListDataModel;
use Illuminate\Database\Eloquent\Collection;
use Town\Contracts\Services\TownServiceInterface;
use Town\Contracts\Repositories\TownRepositoryInterface;

class TownService implements TownServiceInterface
{
    use DataSafetyTrait;

    public function __construct(
        private TownRepositoryInterface $townRepo
    ) {
    }
    public function getTownLists(Request $request): Collection
    {
        // if (!empty($request->district_id) && !empty($request->city_id)) {
        //     $result = $this->townRepo->getTownByDistrictAndCity($request);
        //     return new TownListDataModel($result);
        // }

        $result = $this->townRepo->getTownLists();

        return $result;
    }

    public function getTownPagination(int $perPage, int $page): TownListDataModel
    {
        $result = $this->townRepo->getTownPagination($perPage, $page);

        return new TownListDataModel($result);
    }

    public function createTown(array $data): TownDataModel
    {
        $result = $this->townRepo->createTown($data);

        return new TownDataModel($result);
    }

    public function showTownById(int $id): TownDataModel
    {
        $result = $this->townRepo->showTownById($id);

        if (!empty($result)) {
            $result = new TownDataModel($result);
        }
        return $this->emptyOrThrow($result, 'No pervious saved information');
    }

    public function updateTownById(int $id, $data): TownDataModel
    {
        $result = $this->townRepo->updateTownById($id, $data);

        return $this->showTownById($id);
    }

    public function destroyTownById(int $id): bool
    {
        return $this->townRepo->destroyTownById($id);
    }

    public function getTownByDistrictId(int $id, Request $request): TownListDataModel
    {
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        $result = $this->townRepo->getTownByDistrictId($id, $perPage, $page);

        return new TownListDataModel($result);
    }

    public function getTownByCityId(int $id, Request $request): TownListDataModel
    {
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        $result = $this->townRepo->getTownByCityId($id, $perPage, $page);

        return new TownListDataModel($result);
    }

    public function getTownByTownshipId(int $id, Request $request): TownListDataModel
    {
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        $result = $this->townRepo->getTownByTownshipId($id, $perPage, $page);

        return new TownListDataModel($result);
    }
}
