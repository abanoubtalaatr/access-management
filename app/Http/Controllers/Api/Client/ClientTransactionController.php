<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SalesTransactionResource;
use App\Models\Client;
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
