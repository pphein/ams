<?php

namespace Ward\Services;

use Illuminate\Http\Request;
use App\Helpers\DataSafetyTrait;
use Ward\DataModels\WardDataModel;
use Ward\DataModels\WardListDataModel;
use Illuminate\Database\Eloquent\Collection;
use Ward\Contracts\Services\WardServiceInterface;
use Ward\Contracts\Repositories\WardRepositoryInterface;

class WardService implements WardServiceInterface
{
    use DataSafetyTrait;

    public function __construct(
        private WardRepositoryInterface $wardRepo
    ) {
    }
    public function getWardLists(Request $request): Collection
    {
        // if (!empty($request->district_id) && !empty($request->city_id)) {
        //     $result = $this->wardRepo->getWardByDistrictAndCity($request);
        //     return new WardListDataModel($result);
        // }

        $result = $this->wardRepo->getWardLists();

        return $result;
    }

    public function getWardPagination(int $perPage, int $page): WardListDataModel
    {
        $result = $this->wardRepo->getWardPagination($perPage, $page);

        return new WardListDataModel($result);
    }

    public function firstOrCreateWard(array $data): WardDataModel
    {
        $result = $this->wardRepo->firstOrCreateWard($data);

        return new WardDataModel($result);
    }

    public function showWardById(int $id): WardDataModel
    {
        $result = $this->wardRepo->showWardById($id);

        if (!empty($result)) {
            $result = new WardDataModel($result);
        }
        return $this->emptyOrThrow($result, 'No pervious saved information');
    }

    public function updateWardById(int $id, $data): WardDataModel
    {
        $result = $this->wardRepo->updateWardById($id, $data);

        return $this->showWardById($id);
    }

    public function destroyWardById(int $id): bool
    {
        return $this->wardRepo->destroyWardById($id);
    }

    public function getWardByDistrictId(int $id, Request $request): WardListDataModel
    {
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        $result = $this->wardRepo->getWardByDistrictId($id, $perPage, $page);

        return new WardListDataModel($result);
    }

    public function getWardByCityId(int $id, Request $request): WardListDataModel
    {
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        $result = $this->wardRepo->getWardByCityId($id, $perPage, $page);

        return new WardListDataModel($result);
    }

    public function getWardByTownshipId(int $id, Request $request): WardListDataModel
    {
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        $result = $this->wardRepo->getWardByTownId($id, $perPage, $page);

        return new WardListDataModel($result);
    }
}
