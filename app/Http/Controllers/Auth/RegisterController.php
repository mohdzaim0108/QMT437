<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/register-success';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        $data['role'] = $data['role'] ?? 2;

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'studentId' => ['required', 'regex:/^[0-9]{10}$/', 'unique:student,studentId'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'integer', 'in:2'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'role' => $data['role'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if ($data['role'] == 2) 
        {
            Student::create([
                'studentId' => $data['studentId'],
                'userId' => $user->id,
            ]);
        }

        return $user;
    }

    public function register(Request $request)
    {
        $data = $request->all();
        $data['role'] = $data['role'] ?? 2;

        $this->validator($data)->validate();

        $user = $this->create($data);

        session()->flash('success', 'Successfully registered!');

        return redirect($this->redirectPath());
    }

    public function showRegistrationSuccess()
    {
        return view('auth.register-success');
    }
}
