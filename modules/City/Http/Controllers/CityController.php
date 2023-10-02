<?php

namespace City\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use City\Http\Requests\CreateCityRequest;
use City\Http\Requests\UpdateCityRequest;
use City\Contracts\Services\CityServiceInterface;

class CityController extends Controller
{
    public function __construct(
        private CityServiceInterface $cityService
    ) {
    }

    public function list(Request $request)
    {
        $result = $this->cityService->getCityLists($request);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function create(CreateCityRequest $request)
    {
        $result = $this->cityService->createCity($request->all());
        return response()->json($result->toArray(), Response::HTTP_CREATED);
    }

    public function show(int $id)
    {
        $result = $this->cityService->showCityById($id);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function update(int $id, UpdateCityRequest $request)
    {
        $result = $this->cityService->updateCityById($id, $request->all());
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function destroy(int $id)
    {
        $result = $this->cityService->destroyCityById($id);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    public function getByStateId(int $id, Request $request)
    {
        $result = $this->cityService->getCityByStateId($id, $request);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function getByCountryId(int $id, Request $request)
    {
        $result = $this->cityService->getCityByCountryId($id, $request);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }
}
