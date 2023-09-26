<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Inertia\Response;

class PageController extends Controller
{
    public function __invoke(string $slug): Response
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        return inertia('Page', compact('page'));
    }
}
