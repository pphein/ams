<?php

namespace District\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use District\Http\Requests\CreateDistrictRequest;
use District\Http\Requests\UpdateDistrictRequest;
use District\Contracts\Services\DistrictServiceInterface;

class DistrictController extends Controller
{
    public function __construct(
        private DistrictServiceInterface $districtService
    ) {
    }

    public function list(Request $request)
    {
        if ($request->per_page || $request->page) {
            $perPage = $request->per_page ?? 10;
            $page = $request->page ?? 1;
            $result = $this->districtService->getDistrictPagination($perPage, $page);
        } else {
            $result = $this->districtService->getDistrictLists($request);
        }
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function create(CreateDistrictRequest $request)
    {
        $result = $this->districtService->createDistrict($request->all());
        return response()->json($result->toArray(), Response::HTTP_CREATED);
    }

    public function show(int $id)
    {
        $result = $this->districtService->showDistrictById($id);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function update(int $id, UpdateDistrictRequest $request)
    {
        $result = $this->districtService->updateDistrictById($id, $request->all());
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function destroy(int $id)
    {
        $result = $this->districtService->destroyDistrictById($id);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    public function getByStateId(int $id, Request $request)
    {
        $result = $this->districtService->getDistrictByStateId($id, $request);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function getByCountryId(int $id, Request $request)
    {
        $result = $this->districtService->getDistrictByCountryId($id, $request);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }
}
