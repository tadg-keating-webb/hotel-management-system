<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Inertia\Response;

class ReviewController extends Controller
{
    public function index(): Response
    {
        $reviews = Review::where('approved', true)
            ->orderBy('created_at')
            ->limit(5)
            ->get();

        return inertia('Review/Index', compact('reviews'));
    }
}
