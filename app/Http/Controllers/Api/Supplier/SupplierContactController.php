<?php

namespace App\Http\Controllers\Api\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ContactResource;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SupplierContactController extends Controller
{
    public function index(Request $request, Supplier $supplier): AnonymousResourceCollection
    {
        $contactsQuery = $supplier->contacts();
        $searchTerm = $request->query('search');

        if ($searchTerm) {
            $contactsQuery->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%'.$searchTerm.'%')
                    ->orWhere('email', 'like', '%'.$searchTerm.'%')
                    ->orWhere('phone', 'like', '%'.$searchTerm.'%');
            });
        }

        $contacts = $contactsQuery->get();

        return ContactResource::collection($contacts);
    }
}
