<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\AccountRequest;
use App\Http\Resources\Api\AccountResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\Account;
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
