<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreManagerRequest;
use App\Http\Requests\Auth\StoreParticipantRequest;
use App\Http\Resources\Education\EducationSchoolResource;
use App\Models\EducationSchool;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function create()
    {
        $schools = EducationSchoolResource::collection(EducationSchool::with(['directions'])->get());

        return inertia('auth/Register', compact('schools'));
    }

    public function storeParticipant(StoreParticipantRequest $request)
    {
        $validated = $request->validated();

        $user = $this->storeUser($request->validated());

        new Registered($user);
    }

    public function storeManager(StoreManagerRequest $request)
    {
        $validated = $request->validated();

        $user = $this->storeUser($request->validated());
    }

    private function storeUser(array $data)
    {
        $base_input_data = ['surname', 'name', 'patronymic', 'email', 'phone', 'password', 'role_id'];
        $info_array = [];

        $role = Role::where(
            'title',
            fn() =>
            $data['role'] === 'participant' ? 'участник' : 'руководитель'
        )->first();

        foreach ($base_input_data as $key => $value) {
            $info_array[$key] = $data[$key];
        }

        $user = User::make($info_array);
        $user->role_id = $role->id;

        return $user;
    }
}
