<?php

namespace BirdSol\AccessManagement\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use BirdSol\AccessManagement\Http\Queries\RequestQueryBuilder;
use BirdSol\AccessManagement\Http\Requests\Api\AccountRequest;
use BirdSol\AccessManagement\Http\Resources\Api\AccountResource;
use BirdSol\AccessManagement\Http\Responses\Api\SuccessResponse;
use BirdSol\AccessManagement\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AccountController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        return AccountResource::collection(RequestQueryBuilder::build(Account::query(), $request)->paginate());
    }

    public function store(AccountRequest $request): AccountResource
    {
        $account = Account::create($request->validated());

        return AccountResource::make($account);
    }

    public function show(Account $account): AccountResource
    {
        return AccountResource::make($account);
    }

    public function update(AccountRequest $request, Account $account): AccountResource
    {
        $account->update($request->validated());

        return AccountResource::make($account->refresh());
    }

    public function destroy(Account $account): SuccessResponse
    {
        $account->delete();

        return new SuccessResponse();
    }
}
