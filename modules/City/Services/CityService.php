<?php

namespace City\Services;

use Illuminate\Http\Request;
use App\Helpers\DataSafetyTrait;
use City\DataModels\CityDataModel;
use City\DataModels\CityListDataModel;
use Illuminate\Database\Eloquent\Collection;
use City\Contracts\Services\CityServiceInterface;
use City\Contracts\Repositories\CityRepositoryInterface;

class CityService implements CityServiceInterface
{
    use DataSafetyTrait;

    public function __construct(
        private CityRepositoryInterface $cityRepo
    ) {
    }
    public function getCityLists(Request $request): Collection
    {
        // if (!empty($request->state_id) && !empty($request->country_id)) {
        //     $result = $this->cityRepo->getCityByStateAndCountry($request);
        //     return new CityListDataModel($result);
        // }

        $result = $this->cityRepo->getCityLists();

        return $result;
    }

    public function getCityPagination(int $perPage, int $page): CityListDataModel
    {
        $result = $this->cityRepo->getCityPagination($perPage, $page);

        return new CityListDataModel($result);
    }

    public function firstOrCreateCity(array $data): CityDataModel
    {
        $result = $this->cityRepo->firstOrCreateCity($data);

        return new CityDataModel($result);
    }

    public function showCityById(int $id): CityDataModel
    {
        $result = $this->cityRepo->showCityById($id);

        if (!empty($result)) {
            $result = new CityDataModel($result);
        }
        return $this->emptyOrThrow($result, 'No pervious saved information');
    }

    public function updateCityById(int $id, $data): CityDataModel
    {
        $result = $this->cityRepo->updateCityById($id, $data);

        return $this->showCityById($id);
    }

    public function destroyCityById(int $id): bool
    {
        return $this->cityRepo->destroyCityById($id);
    }

    public function getCityByStateId(int $id, Request $request): CityListDataModel
    {
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        $result = $this->cityRepo->getCityByStateId($id, $perPage, $page);

        return new CityListDataModel($result);
    }

    public function getCityByCountryId(int $id, Request $request): CityListDataModel
    {
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        $result = $this->cityRepo->getCityByCountryId($id, $perPage, $page);

        return new CityListDataModel($result);
    }
}
