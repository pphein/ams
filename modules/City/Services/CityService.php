<?php

namespace City\Services;

use Illuminate\Http\Request;
use App\Helpers\DataSafetyTrait;
use City\DataModels\CityDataModel;
use City\DataModels\CityListDataModel;
use City\Contracts\Services\CityServiceInterface;
use City\Contracts\Repositories\CityRepositoryInterface;

class CityService implements CityServiceInterface
{
    use DataSafetyTrait;

    public function __construct(
        private CityRepositoryInterface $cityRepo
    ) {
    }
    public function getCityLists(Request $request): CityListDataModel
    {
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        if (!empty($request->state_id) && !empty($request->country_id)) {
            $result = $this->CityRepo->getCityByStateAndCountry($request);
            return new CityListDataModel($result);
        }

        $result = $this->CityRepo->getCityLists($perPage, $page);

        return new CityListDataModel($result);
    }

    public function createCity(array $data): CityDataModel
    {
        $result = $this->CityRepo->createCity($data);

        return new CityDataModel($result);
    }

    public function showCityById(int $id): CityDataModel
    {
        $result = $this->CityRepo->showCityById($id);

        if (!empty($result)) {
            $result = new CityDataModel($result);
        }
        return $this->emptyOrThrow($result, 'No pervious saved information');
    }

    public function updateCityById(int $id, $data): CityDataModel
    {
        $result = $this->CityRepo->updateCityById($id, $data);

        return $this->showCityById($id);
    }

    public function destroyCityById(int $id): bool
    {
        return $this->CityRepo->destroyCityById($id);
    }

    public function getCityByStateId(int $id, Request $request): CityListDataModel
    {
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        $result = $this->CityRepo->getCityByStateId($id, $perPage, $page);

        return new CityListDataModel($result);
    }

    public function getCityByCountryId(int $id, Request $request): CityListDataModel
    {
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        $result = $this->CityRepo->getCityByCountryId($id, $perPage, $page);

        return new CityListDataModel($result);
    }
}
