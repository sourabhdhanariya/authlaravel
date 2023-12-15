<?php

namespace App\Http\Controllers;

use App\models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
/**
 * Class LoginController
 *
 * @package App\Http\Controllers
 */
class LoginController extends Controller
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
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (\Auth::attempt($request->only('email', 'password'))) {
            return redirect('dashboard');
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
    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'lastname'=>'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
            'phone'=>'required|numeric|digits:8',            
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'lastname' => $request->lastname,
        ]);
        if (\Auth::attempt($request->only('name','email', 'password', 'phone','lastname'))) {
            return redirect('login');
        }
        return redirect('register')->withErrors('Error');

    }
    public function dashboard()
    {
        return view('dashboard');
    }
}
