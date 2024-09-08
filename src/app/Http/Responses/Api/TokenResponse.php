<?php

namespace BirdSol\AccessManagement\App\Http\Responses\Api;

use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class TokenResponse implements Responsable
{
    public int $status;

    public function __construct(int $status, public User $user)
    {
        $this->status = $status;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function toResponse($request): Response
    {
        return response()->json([
            'access_token' => $this->user->createToken('authToken')->plainTextToken,
            'token_type' => 'Bearer',
        ], $this->status);
    }
}
