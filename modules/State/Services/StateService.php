<?php

namespace State\Services;

use Illuminate\Http\Request;
use App\Helpers\DataSafetyTrait;
use State\DataModels\StateDataModel;
use State\DataModels\StateListDataModel;
use Illuminate\Database\Eloquent\Collection;
use State\Contracts\Services\StateServiceInterface;
use State\Contracts\Repositories\StateRepositoryInterface;

class StateService implements StateServiceInterface
{
    use DataSafetyTrait;

    public function __construct(
        private StateRepositoryInterface $stateRepo
    ) {
    }

    public function getStateLists(Request $request): Collection
    {
        $result = $this->stateRepo->getStateLists();

        return $result;
    }

    public function firstOrCreateState(array $data): StateDataModel
    {
        $result = $this->stateRepo->firstOrCreateState($data);

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

    public function getStatePagination(int $perPage, int $page): StateListDataModel
    {
        $result = $this->stateRepo->getStatePagination($perPage, $page);

        return new StateListDataModel($result);
    }

    public function getStateByCountryId(int $id, Request $request): StateListDataModel
    {
        $perPage = $request->per_page ?? 10;
        $page = $request->page ?? 1;

        $result = $this->stateRepo->getStateByCountryId($id, $perPage, $page);

        return new StateListDataModel($result);
    }
}
