<?php

namespace App\Http\Controllers\Api\Contact;

use App\Http\Controllers\Controller;
use App\Http\Queries\RequestQueryBuilder;
use App\Http\Requests\Api\StoreContactRequest;
use App\Http\Requests\Api\UpdateContactRequest;
use App\Http\Resources\Api\ContactResource;
use App\Http\Responses\Api\SuccessResponse;
use App\Models\Contact;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ContactController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Contact::class);

        return ContactResource::collection(RequestQueryBuilder::build(Contact::query(), $request)->paginate());
    }

    public function store(StoreContactRequest $request): ContactResource
    {
        $this->authorize('create', Contact::class);

        $contact = Contact::create($request->validated());

        return ContactResource::make($contact);
    }

    public function show(Contact $contact): ContactResource
    {
        $this->authorize('view', $contact);

        return ContactResource::make($contact->load('contactable'));
    }

    public function update(UpdateContactRequest $request, Contact $contact): ContactResource
    {
        $this->authorize('update', $contact);

        $contact->update($request->validated());

        return ContactResource::make($contact->load('contactable'));
    }

    public function destroy(Contact $contact): SuccessResponse
    {
        $this->authorize('delete', $contact);

        $contact->delete();

        return new SuccessResponse();
    }
}
