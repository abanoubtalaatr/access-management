<?php

namespace App\Http\Controllers\Api\Station;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AccountResource;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StationAccountController extends Controller
{
    public function index(Request $request, Station $station): AnonymousResourceCollection
    {

        $accountsQuery = $station->accounts()->with('accountable');

        if ($request->has('search')) {
            $searchTerm = $request->input('search');

            $accountsQuery->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%'.$searchTerm.'%');
            });
        }

        $accounts = $accountsQuery->get();

        return AccountResource::collection($accounts);
    }
}
