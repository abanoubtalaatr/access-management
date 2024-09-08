<?php

namespace BirdSol\AccessManagement\Http\Responses\Api;

use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class SuccessResponse implements Responsable
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function toResponse($request): Response
    {
        // TODO
        return response()->json([
            'message' => 'success',
        ], Response::HTTP_OK);
    }
}
