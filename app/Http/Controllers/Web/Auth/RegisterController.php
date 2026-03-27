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
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    private array $base_input_data = ['surname', 'name', 'patronymic', 'email', 'phone', 'password'];
    public function create()
    {
        $schools = EducationSchoolResource::collection(EducationSchool::with(['directions'])->get());

        return inertia('auth/Register', compact('schools'));
    }

    public function store(Request $request)
    {
        $role = $request->role;

        $config = match ($role) {
            'участник' => [
                'request' => StoreParticipantRequest::class,
                'model' => Participant::class,
            ],
            'руководитель' => [
                'request' => StoreManagerRequest::class,
                'model' => Manager::class,
            ],
        };

        $validated = app($config['request'])->validated();

        $user = $this->storeUser($validated, $role);

        $new_user_fields = array_diff_key($validated, $this->base_input_data);
        $new_user = $config['model']::make($new_user_fields);
        $new_user->user_id = $user->id;
        $new_user->education_school_id;
        $new_user->save();

        if ($role === 'участник') {
            Auth::login($user);
            event(new Registered($user));
            return redirect()->route('verification.notice');
        } else {
            return redirect()->route('olympiad.index')->with('success', 'Ваше заявление оставлено на рассмотрение администратором');
        }
    }

    private function storeUser(array $data, string $requestRole)
    {
        $info_array = [];

        dd($data);

        foreach ($this->base_input_data as $value) {
            $info_array[$value] = $data[$value];
        }

        try {
            $currentRole = Role::where('title', $requestRole)->first();
            $user = User::make($info_array);
            $user->role_id = $currentRole->id;
            $user->save();

            return $user;
        } catch (Exception $e) {
            return back()->with('warning', 'Произошла ошибка, попробуйте позже');
        }
    }
}
