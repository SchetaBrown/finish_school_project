<?php

namespace App\Http\Controllers\Web\Olympiad;

use App\Http\Controllers\Controller;
use App\Models\Olympiad;
use App\Repositories\Interfaces\OlympiadRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OlympiadController extends Controller
{
    private OlympiadRepositoryInterface $olympiadRepository;

    public function __construct(OlympiadRepositoryInterface $olympiadRepository)
    {
        $this->olympiadRepository = $olympiadRepository;
    }

    public function index(Request $request)
    {
        return response()->json($this->olympiadRepository->getAllOlympiads($request, 10));

        return Inertia::render('Index', [
            'olympiads' => $this->olympiadRepository->getAllOlympiads($request, 10),
        ]);
    }

    public function show(Olympiad $olympiad)
    {
        return response()->json($this->olympiadRepository->getOlympiadById($olympiad->id));

        return Inertia::render('olympiad/Show', [
            'olympiad' => $this->olympiadRepository->getOlympiadById($olympiad->id),
        ]);
    }
}
