<?php

namespace App\Http\Controllers\Web\Admin\Education;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\EducationDirectionRepositoryInterface;

class AdminEducationDirectionController extends Controller
{
    private EducationDirectionRepositoryInterface $educationDirectionRepository;

    public function __construct(EducationDirectionRepositoryInterface $educationDirectionRepository)
    {
        $this->educationDirectionRepository = $educationDirectionRepository;
    }

    public function index()
    {

    }
}
