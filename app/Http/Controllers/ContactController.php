<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Inertia\Response;

class ContactController extends Controller
{
    public function create(): Response
    {
        return inertia('Contact/Create');
    }

    public function store(ContactRequest $request): RedirectResponse
    {
        Contact::create(Arr::except($request->validated(), 'terms'));

        return to_route('contact.create')->with('success', __("Your request has been sent successfully. <br> A member of our team will contact you shortly."));
    }
}
