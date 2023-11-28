<?php

namespace Town\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Town\Http\Requests\CreateTownRequest;
use Town\Http\Requests\UpdateTownRequest;
use Town\Contracts\Services\TownServiceInterface;

class TownController extends Controller
{
    public function __construct(
        private TownServiceInterface $townService
    ) {
    }

    public function list(Request $request)
    {
        if ($request->per_page || $request->page) {
            $perPage = $request->per_page ?? 10;
            $page = $request->page ?? 1;
            $result = $this->townService->getTownPagination($perPage, $page);
        } else {
            $result = $this->townService->getTownLists($request);
        }
        
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function create(CreateTownRequest $request)
    {
        $result = $this->townService->createTown($request->all());
        return response()->json($result->toArray(), Response::HTTP_CREATED);
    }

    public function show(int $id)
    {
        $result = $this->townService->showTownById($id);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function update(int $id, UpdateTownRequest $request)
    {
        $result = $this->townService->updateTownById($id, $request->all());
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function destroy(int $id)
    {
        $result = $this->townService->destroyTownById($id);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    public function getByDistrictId(int $id, Request $request)
    {
        $result = $this->townService->getTownByDistrictId($id, $request);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function getByCityId(int $id, Request $request)
    {
        $result = $this->townService->getTownByCityId($id, $request);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function getByTownshipId(int $id, Request $request)
    {
        $result = $this->townService->getTownByTownshipId($id, $request);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }
}
