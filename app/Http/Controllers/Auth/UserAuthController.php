<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Carbon\Carbon;

class UserAuthController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $title = 'Login to your Account';
        return view('auth.user.login')->with(['title' => $title]);
    }

    public function create()
    {
        $title = 'Create New Account';
        return view('auth.user.register')->with(['title' => $title]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:32|confirmed',
            'captcha_text' => 'required'
        ]);

        if($request->captcha_image !== $request->captcha_text)
        {
            return redirect()->back()->with(['captcha_error' => 'Wrong Captcha']);
        }
        else{
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            {
                return redirect()->intended(route('home'));
            }
            else{
                User::create($request->all());

                return redirect()->route('login')->with(['success' => 'Your account has been created, Login to continue']);
            }
        }
    }

    public function login()
    {
        $title = 'Login to your Account';
        return view('auth.user.login')->with(['title' => $title]);
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'captcha_text' => 'required'
        ]);

        if($request->captcha_image !== $request->captcha_text)
        {
            return redirect()->back()->with(['captcha_error' => 'Wrong Captcha']);
        }
        else{
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active' => 1]))
            {
                $user = User::find(Auth::user()->id);
                $user->login_ip = $request->ip();
                $user->save();
                return redirect()->intended(route('home'));
            }
            else{
                return back()->with(['error' => 'Please check email/password and try again!']);
            }
        }
    }

    public function logout()
    {
        $user = User::find(Auth::user()->id);
        $user->last_logout = Carbon::now();
        $user->save();
        Auth::logout();
        return redirect()->route('login');
    }
}
