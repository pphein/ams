<?php

namespace District\Services;

use Illuminate\Http\Request;
use App\Helpers\DataSafetyTrait;
use District\DataModels\DistrictDataModel;
use District\DataModels\DistrictListDataModel;
use District\Contracts\Services\DistrictServiceInterface;
use District\Contracts\Repositories\DistrictRepositoryInterface;

class DistrictService implements DistrictServiceInterface
{
    use DataSafetyTrait;

    public function __construct(
        private DistrictRepositoryInterface $districtRepo
    ) {
    }
    public function getDistrictLists(Request $request): DistrictListDataModel
    {
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        if (!empty($request->state_id) && !empty($request->country_id)) {
            $result = $this->districtRepo->getDistrictByStateAndCountry($request);
            return new DistrictListDataModel($result);
        }

        $result = $this->districtRepo->getDistrictLists($perPage, $page);

        return new DistrictListDataModel($result);
    }

    public function createDistrict(array $data): DistrictDataModel
    {
        $result = $this->districtRepo->createDistrict($data);

        return new DistrictDataModel($result);
    }

    public function showDistrictById(int $id): DistrictDataModel
    {
        $result = $this->districtRepo->showDistrictById($id);

        if (!empty($result)) {
            $result = new DistrictDataModel($result);
        }
        return $this->emptyOrThrow($result, 'No pervious saved information');
    }

    public function updateDistrictById(int $id, $data): DistrictDataModel
    {
        $result = $this->districtRepo->updateDistrictById($id, $data);

        return $this->showDistrictById($id);
    }

    public function destroyDistrictById(int $id): bool
    {
        return $this->districtRepo->destroyDistrictById($id);
    }

    public function getDistrictByStateId(int $id, Request $request): DistrictListDataModel
    {
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        $result = $this->districtRepo->getDistrictByStateId($id, $perPage, $page);

        return new DistrictListDataModel($result);
    }

    public function getDistrictByCountryId(int $id, Request $request): DistrictListDataModel
    {
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        $result = $this->districtRepo->getDistrictByCountryId($id, $perPage, $page);

        return new DistrictListDataModel($result);
    }
}
