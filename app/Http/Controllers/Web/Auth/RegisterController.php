<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreManagerRequest;
use App\Http\Requests\Auth\StoreParticipantRequest;
use App\Http\Resources\Education\EducationSchoolResource;
use App\Models\EducationSchool;
use App\Models\Manager;
use App\Models\Participant;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    private array $base_input_data = ['surname', 'name', 'patronymic', 'email', 'phone', 'password'];
    public function create()
    {
        $schools = EducationSchoolResource::collection(EducationSchool::with(['directions'])->get());

        return inertia('auth/Register', compact('schools'));
    }

    public function store()
    {

    }

    public function storeParticipant(StoreParticipantRequest $request)
    {
        $validated = $request->validated();

        $user = $this->storeUser($validated, $request->role);

        $participant_fields = array_diff_key($validated, $this->base_input_data, ['education_school_title']);
        $school = EducationSchool::where('full_name', $request->education_school_title)->orWhere('short_name', $request->education_school_title)->first();
        $participant = Participant::make($participant_fields);
        $participant->user_id = $user->id;
        $participant->education_school_id = $school->id;
        $participant->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('verification.notice');
    }

    public function storeManager(StoreManagerRequest $request)
    {
        $validated = $request->validated();
        $user = $this->storeUser($validated, $request->role);

        $manager_fields = array_diff_key($validated, $this->base_input_data, ['education_school_title']);
        $school = EducationSchool::where('full_name', $request->education_school_title)->orWhere('short_name', $request->education_school_title)->first();
        $manager = Manager::make($manager_fields);
        $manager->user_id = $user->id;
        $manager->education_school_id = $school->id;
        $manager->save();

        return redirect()->route('olympiad.index')->with('success', 'Ваше заявление оставлено на рассмотрение администратором');
    }

    private function storeUser(array $data, string $requestRole)
    {
        $info_array = [];

        foreach ($this->base_input_data as $key => $value) {
            $info_array[$value] = $data[$value];
        }

        $currentRole = Role::where('title', $requestRole)->first();
        $user = User::make($info_array);
        $user->role_id = $currentRole->id;
        $user->save();

        return $user;
    }
}
