<?php

namespace App\Http\Controllers;

use App\Jobs\CustomerJob;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Botique;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm() {
        if (auth()->check()) {
            return redirect()->route('botiques.index'); // Redirect authenticated users to the dashboard
        }
        return view('auth.login');
    }

    public function registerForm() {
        if (auth()->check()) {
            return redirect()->route('botiques.index'); // Redirect authenticated users to the dashboard
        }

        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->email_verified_at == null) {
            return redirect('/')->with('error', 'Sorry, your account is not yet verified.');
        }

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            if (Auth::user()->email_verified_at) {
                return redirect()->route('botiques.index');
            } else {
                Auth::logout();
                return redirect()->route('loginForm')->with('error', 'Email not verified. Please check your email for verification instructions.');
            }
        }

        return redirect()->route('loginForm')->with('error', 'Invalid credentials');
    }


    public function register(Request $request) {
        $request->validate([
            'name'  => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|string|min:6'
        ]);

        $token = Str::random(24);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => $token
        ]);

        // dispatch(new CustomerJob($user->id));
        CustomerJob::dispatch($user);
        // Mail::send('auth.verification-mail', ['user' => $user], function($mail) use($user){
        //     $mail->to($user->email);
        //     $mail->subject('Account Verification');
        // });

        return redirect('/')->with('message', 'Your account has been created. Please check email for the verification.');
    }

    public function verification(User $user, $token) {
        if($user->remember_token !== $token) {
            return redirect('/')->with('error', 'Invalid token.');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect('/')->with('message', 'Your account has been verified');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/')->with('message', 'Logged out successfully.');
    }

}
