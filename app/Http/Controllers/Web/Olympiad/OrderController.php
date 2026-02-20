<?php

namespace App\Http\Controllers\Web\Olympiad;

use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function create()
    {
        return inertia('olympiad/Create');
    }

    public function store()
    {

    }
}
