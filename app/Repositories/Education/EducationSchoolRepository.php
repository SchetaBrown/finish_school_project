<?php

namespace App\Repositories\Education;

use App\Http\Resources\Education\EducationSchoolResource;
use App\Models\EducationSchool;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\EducationSchoolRepositoryInterface;

class EducationSchoolRepository extends BaseRepository implements EducationSchoolRepositoryInterface
{
    public function getAllEducationSchools()
    {
        return EducationSchoolResource::collection(EducationSchool::with(['directions', 'managers', 'city'])->paginate(parent::PER_PAGE));
    }
}
