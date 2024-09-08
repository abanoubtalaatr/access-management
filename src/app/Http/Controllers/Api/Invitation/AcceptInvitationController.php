<?php

namespace BirdSol\AccessManagement\Http\Controllers\Api\Invitation;

use App\Http\Controllers\Controller;
use BirdSol\AccessManagement\Http\Requests\Api\AcceptInvitationRequest;
use BirdSol\AccessManagement\Http\Resources\Api\InvitationResource;
use BirdSol\AccessManagement\Http\Responses\Api\TokenResponse;
use BirdSol\AccessManagement\Models\Invitation;
use BirdSol\AccessManagement\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AcceptInvitationController extends Controller
{
    use AuthorizesRequests;

    public function show(Invitation $invitation): InvitationResource
    {
        $this->authorize('view', $invitation);

        return InvitationResource::make($invitation);
    }

    public function store(AcceptInvitationRequest $request): TokenResponse
    {
        $invitation = Invitation::findOrFail($request->invitation_id);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $user->roles()->attach($invitation->role_id);

        $invitation->delete();

        return new TokenResponse(200, $user);
    }
}
