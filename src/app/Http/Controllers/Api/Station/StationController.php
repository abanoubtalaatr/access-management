<?php

namespace App\Http\Controllers\Api\Station;

use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\StationRequest;
use App\Http\Resources\Api\StationResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StationController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        return StationResource::collection(RequestQueryBuilder::build(Station::query(), $request)->paginate());
    }

    public function store(StationRequest $request): StationResource
    {
        $station = Station::create($request->validated());

        return StationResource::make($station);
    }

    public function show(Station $station): StationResource
    {
        return StationResource::make($station);
    }

    public function update(StationRequest $request, Station $station): StationResource
    {
        $station->update($request->validated());

        return StationResource::make($station->refresh());
    }

    public function destroy(Station $station): SuccessResponse
    {
        $station->delete();

        return new SuccessResponse();
    }
}
