<?php

namespace App\Http\Controllers\Web\Admin\Olympiad;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\OlympiadRepositoryInterface;

class AdminDirectionController extends Controller
{
    private OlympiadRepositoryInterface $olympiadRepository;

    public function __construct(OlympiadRepositoryInterface $olympiadRepository)
    {
        $this->olympiadRepository = $olympiadRepository;
    }

    public function index()
    {
        return response()->json($this->olympiadRepository->getAllOlympiadDirections());
    }

    public function store()
    {

    }

    public function edit()
    {

    }
}
