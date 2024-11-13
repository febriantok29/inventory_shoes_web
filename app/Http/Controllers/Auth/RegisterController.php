<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Master\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle the registration request.
     */
    public function register(Request $request)
    {
        // Validate the incoming request data
        $this->validator($request->all())->validate();

        // Create the new employee and redirect to the dashboard or login page
        $employee = $this->create($request->all());

        // Optional: Auto-login the user
        Auth::login($employee);

        return redirect()->route('dashboard')->with('success', 'Registration successful.');
    }

    /**
     * Validate the registration request data.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255|unique:m_employees',
            'password' => 'required|string|min:8|confirmed',
            'name' => 'required|string|max:128',
            'email' => 'required|string|email|max:255|unique:m_employees',
        ]);
    }

    /**
     * Create a new employee instance.
     */
    protected function create(array $data)
    {
        // Date now
        $now = now();
        $year = $now->year;
        $month = $now->month;
        $day = $now->day;
        $lastId = Employee::count();

        $code = $year . $month . $day . str_pad($lastId + 1, 5, '0', STR_PAD_LEFT);

        return Employee::create([
            'code' => $code,
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => 'admin',
        ]);
    }
}
