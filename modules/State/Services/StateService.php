<?php

namespace State\Services;

use Illuminate\Http\Request;
use App\Helpers\DataSafetyTrait;
use State\DataModels\StateDataModel;
use State\DataModels\StateListDataModel;
use State\Contracts\Services\StateServiceInterface;
use State\Contracts\Repositories\StateRepositoryInterface;

class StateService implements StateServiceInterface
{
    use DataSafetyTrait;

    public function __construct(
        private StateRepositoryInterface $stateRepo
    ) {
    }
    public function getStateLists(Request $request): StateListDataModel
    {
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        if (!empty($request->country_id)) {
            $result = $this->stateRepo->getStateByDistrictAndCity($request);
            return new StateListDataModel($result);
        }

        $result = $this->stateRepo->getStateLists($perPage, $page);

        return new StateListDataModel($result);
    }

    public function createState(array $data): StateDataModel
    {
        $result = $this->stateRepo->createState($data);

        return new StateDataModel($result);
    }

    public function showStateById(int $id): StateDataModel
    {
        $result = $this->stateRepo->showStateById($id);

        if (!empty($result)) {
            $result = new StateDataModel($result);
        }
        return $this->emptyOrThrow($result, 'No pervious saved information');
    }

    public function updateStateById(int $id, $data): StateDataModel
    {
        $result = $this->stateRepo->updateStateById($id, $data);

        return $this->showStateById($id);
    }

    public function destroyStateById(int $id): bool
    {
        return $this->stateRepo->destroyStateById($id);
    }

    public function getStateByCountryId(int $id, Request $request): StateListDataModel
    {
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        $result = $this->stateRepo->getStateByCountryId($id, $perPage, $page);

        return new StateListDataModel($result);
    }
}
