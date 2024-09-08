<?php

namespace BirdSol\AccessManagement\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use BirdSol\AccessManagement\Http\Queries\RequestQueryBuilder;
use BirdSol\AccessManagement\Http\Requests\Api\StoreClientRequest;
use BirdSol\AccessManagement\Http\Requests\Api\UpdateClientRequest;
use BirdSol\AccessManagement\Http\Resources\ClientResource;
use BirdSol\AccessManagement\Http\Responses\Api\SuccessResponse;
use BirdSol\AccessManagement\Models\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClientController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Client::class);

        return ClientResource::collection(RequestQueryBuilder::build(Client::query(), $request)->paginate());
    }

    public function store(StoreClientRequest $request): ClientResource
    {
        $this->authorize('create', Client::class);

        $client = Client::create($request->validated());

        return ClientResource::make($client);
    }

    public function show(Client $client): ClientResource
    {
        $this->authorize('view', $client);

        return ClientResource::make($client);
    }

    public function update(UpdateClientRequest $request, Client $client): ClientResource
    {
        $this->authorize('update', $client);

        $client->update($request->validated());

        return ClientResource::make($client->refresh());
    }

    public function destroy(Client $client): SuccessResponse
    {
        $this->authorize('delete', $client);

        $client->delete();

        return new SuccessResponse();
    }
}
