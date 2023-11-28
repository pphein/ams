<?php

namespace Ward\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Ward\Http\Requests\CreateWardRequest;
use Ward\Http\Requests\UpdateWardRequest;
use Ward\Contracts\Services\WardServiceInterface;

class WardController extends Controller
{
    public function __construct(
        private WardServiceInterface $wardService
    ) {
    }

    public function list(Request $request)
    {
        if ($request->per_page || $request->page) {
            $perPage = $request->per_page ?? 10;
            $page = $request->page ?? 1;
            $result = $this->wardService->getWardPagination($perPage, $page);
        } else {
            $result = $this->wardService->getWardLists($request);
        }
        
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function create(CreateWardRequest $request)
    {
        $result = $this->wardService->createWard($request->all());
        return response()->json($result->toArray(), Response::HTTP_CREATED);
    }

    public function show(int $id)
    {
        $result = $this->wardService->showWardById($id);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function update(int $id, UpdateWardRequest $request)
    {
        $result = $this->wardService->updateWardById($id, $request->all());
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function destroy(int $id)
    {
        $result = $this->wardService->destroyWardById($id);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    public function getByDistrictId(int $id, Request $request)
    {
        $result = $this->wardService->getWardByDistrictId($id, $request);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function getByCityId(int $id, Request $request)
    {
        $result = $this->wardService->getWardByCityId($id, $request);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function getByWardshipId(int $id, Request $request)
    {
        $result = $this->wardService->getWardByTownshipshipId($id, $request);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }

    public function getByTownId(int $id, Request $request)
    {
        $result = $this->wardService->getWardByTownId($id, $request);
        return response()->json($result->toArray(), Response::HTTP_OK);
    }
}
