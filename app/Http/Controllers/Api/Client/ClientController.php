<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\StoreClientRequest;
use App\Http\Requests\Api\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\Client;
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
