<?php

namespace BirdSol\AccessManagement\Http\Controllers\Api\Invitation;

use App\Http\Controllers\Controller;
use BirdSol\AccessManagement\Http\Queries\RequestQueryBuilder;
use BirdSol\AccessManagement\Http\Requests\Api\InvitationRequest;
use BirdSol\AccessManagement\Http\Requests\Api\UpdateInvitationRequest;
use BirdSol\AccessManagement\Http\Resources\Api\InvitationResource;
use BirdSol\AccessManagement\Http\Responses\Api\SuccessResponse;
use BirdSol\AccessManagement\Models\Invitation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InvitationController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Invitation::class);

        return InvitationResource::collection(
            RequestQueryBuilder::build(Invitation::query(), $request)->paginate()
        );
    }

    public function show(Invitation $invitation): InvitationResource
    {
        $this->authorize('view', $invitation);

        return InvitationResource::make($invitation);
    }

    public function store(InvitationRequest $request): InvitationResource
    {
        $this->authorize('create', Invitation::class);

        $invitation = Invitation::create($request->validated());

        return InvitationResource::make($invitation);
    }

    public function update(UpdateInvitationRequest $request, Invitation $invitation): InvitationResource
    {
        $this->authorize('update', $invitation);

        $invitation->update($request->validated());

        return InvitationResource::make($invitation->refresh());
    }

    public function destroy(Invitation $invitation): SuccessResponse
    {
        $this->authorize('delete', $invitation);

        $invitation->delete();

        return new SuccessResponse();
    }
}
