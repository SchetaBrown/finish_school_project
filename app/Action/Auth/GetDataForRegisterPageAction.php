<?php

namespace App\Action\Auth;

use App\Models\EducationSchool;

class GetDataForRegisterPageAction
{
    public function execute()
    {
        $schools = EducationSchool::get();

        return compact(['']);
    }
}
