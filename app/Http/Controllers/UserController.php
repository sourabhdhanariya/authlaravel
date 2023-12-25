<?php

namespace App\Http\Controllers;

use App\Mail\SendTestMail;
use App\models\User; 
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

/**
 * Class LoginController
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
{

    /**
     * Display the login form.
     *
     * @return View
     */
    public function index()
    {
        return view('login');
    }

    /**
     * login
     * @param Request $request
     */
    public function login(LoginRequest $request)
    {
        $request->validated();
        if (\Auth::attempt($request->only('email', 'password'))) {
            return redirect('home');
        }
        return redirect('login')->withErrors(['error' => 'Login details are not valid']);
    }
    /**
     */

    public function logout()
    {
        \Session::flush();
        \Auth::logout();
        return redirect('login');
    }
    public function registerView()
    {
        return view('register');
    }

    public function register(RegistrationRequest $request)
    {
        
        $request->validated();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'lastname' => $request->lastname,
        ]);

        // Send email
        Mail::to($request->email)
            ->send(new SendTestMail($user));

        if (\Auth::attempt($request->only('email', 'password'))) {
            return redirect('login');
        }

        return redirect('register')->withErrors('Error');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
