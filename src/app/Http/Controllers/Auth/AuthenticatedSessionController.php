<?php

namespace BirdSol\AccessManagement\App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use BirdSol\AccessManagement\App\Http\Requests\Auth\LoginRequest;
use BirdSol\AccessManagement\App\Http\Responses\Api\TokenResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $credentials = $request->validated();
        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            return new TokenResponse(200, $user);
        }

        return abort(403);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        if ($request->user() && $request->user()->currentAccessToken()) {

            $request->user()->currentAccessToken()->delete();
        }

        return new Response(200);
    }
}
