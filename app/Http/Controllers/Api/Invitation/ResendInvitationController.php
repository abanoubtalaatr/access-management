<?php

namespace App\Http\Controllers\Api\Invitation;

use App\Http\Controllers\Controller;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\Invitation;
use App\Notifications\InvitationNotification;
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
