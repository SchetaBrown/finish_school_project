<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Role;

class IndexController extends Controller
{
    public function __invoke()
    {
        $roles = Role::get();
        return response()->json($roles);
        // return inertia('Index', [
        //     ''
        // ]);
    }
}
