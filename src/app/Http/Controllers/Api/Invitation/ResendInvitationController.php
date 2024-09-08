<?php

namespace BirdSol\AccessManagement\App\Http\Controllers\Api\Invitation;

use App\Http\Controllers\Controller;
use BirdSol\AccessManagement\App\Http\Responses\Api\SuccessResponse;
use BirdSol\AccessManagement\App\Models\Invitation;
use BirdSol\AccessManagement\Notifications\InvitationNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ResendInvitationController extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Request $request, Invitation $invitation): SuccessResponse
    {
        $this->authorize('update', $invitation);

        $invitation->notify(new InvitationNotification($invitation));

        return new SuccessResponse();
    }
}
