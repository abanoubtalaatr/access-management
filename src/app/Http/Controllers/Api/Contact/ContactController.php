<?php

namespace BirdSol\AccessManagement\Http\Controllers\Api\Contact;

use App\Http\Controllers\Controller;
use BirdSol\AccessManagement\Http\Queries\RequestQueryBuilder;
use BirdSol\AccessManagement\Http\Requests\Api\StoreContactRequest;
use BirdSol\AccessManagement\Http\Requests\Api\UpdateContactRequest;
use BirdSol\AccessManagement\Http\Resources\Api\ContactResource;
use BirdSol\AccessManagement\Http\Responses\Api\SuccessResponse;
use BirdSol\AccessManagement\Models\Contact;
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
