<?php

namespace BirdSol\AccessManagement\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use BirdSol\AccessManagement\Http\Resources\Api\SalesTransactionResource;
use BirdSol\AccessManagement\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClientTransactionController extends Controller
{
    public function index(Request $request, Client $client): AnonymousResourceCollection
    {
        $query = $client->salesTransactions();

        $transactions = $query->get();

        return SalesTransactionResource::collection($transactions);
    }
}
