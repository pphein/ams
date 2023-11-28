<?php

namespace State\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use State\Http\Requests\CreateStateRequest;
use State\Http\Requests\UpdateStateRequest;
use State\Contracts\Services\StateServiceInterface;

class StateController extends Controller
{
    public function __construct(
        private StateServiceInterface $stateService
    ) {
    }

    public function list(Request $request)
    {
        if ($request->per_page || $request->page) {
            $perPage = $request->per_page ?? 10;
            $page = $request->page ?? 1;
            $result = $this->stateService->getStatePagination($perPage, $page);
        } else {
            $result = $this->stateService->getStateLists($request);
        }

        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function create(CreateStateRequest $request)
    {
        $result = $this->stateService->createState($request->all());
        return response()->json($result->toArray(), Response::HTTP_CREATED);
    }

    public function show(int $id)
    {
        $result = $this->stateService->showStateById($id);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function update(int $id, UpdateStateRequest $request)
    {
        $result = $this->stateService->updateStateById($id, $request->all());
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function destroy(int $id)
    {
        $result = $this->stateService->destroyStateById($id);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    public function getByCountryId(int $id, Request $request)
    {
        $result = $this->stateService->getStateByCountryId($id, $request);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }
}
