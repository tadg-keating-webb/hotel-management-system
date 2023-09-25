<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Inertia\Response;

class TripController extends Controller
{
    public function index(): Response
    {
        $trips = Trip::all();
        return inertia('Trip/Index', compact('trips'));
    }

    public function show(Trip $trip): Response
    {
        return inertia('Trip/Show', compact('trip'));
    }
}
