<?php

namespace Township\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Township\Http\Requests\CreateTownshipRequest;
use Township\Http\Requests\UpdateTownshipRequest;
use Township\Contracts\Services\TownshipServiceInterface;

class TownshipController extends Controller
{
    public function __construct(
        private TownshipServiceInterface $townshipService
    ) {
    }

    public function list(Request $request)
    {
        if ($request->per_page || $request->page) {
            $perPage = $request->per_page ?? 10;
            $page = $request->page ?? 1;
            $result = $this->townshipService->getTownshipPagination($perPage, $page);
        } else {
            $result = $this->townshipService->getTownshipLists($request);
        }
        
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function create(CreateTownshipRequest $request)
    {
        $result = $this->townshipService->createTownship($request->all());
        return response()->json($result->toArray(), Response::HTTP_CREATED);
    }

    public function show(int $id)
    {
        $result = $this->townshipService->showTownshipById($id);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function update(int $id, UpdateTownshipRequest $request)
    {
        $result = $this->townshipService->updateTownshipById($id, $request->all());
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function destroy(int $id)
    {
        $result = $this->townshipService->destroyTownshipById($id);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    public function getByDistrictId(int $id, Request $request)
    {
        $result = $this->townshipService->getTownshipByDistrictId($id, $request);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function getByCityId(int $id, Request $request)
    {
        $result = $this->townshipService->getTownshipByCityId($id, $request);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function getByCountryId(int $id, Request $request)
    {
        $result = $this->townshipService->getTownshipByCountryId($id, $request);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }
}
