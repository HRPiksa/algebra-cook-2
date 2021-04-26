<?php

namespace App\Http\Controllers;

use App\Events\UserSuccessfulLogin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        //dd($request);
        $request->validate(
            array(
                'email'    => 'required|email',
                'password' => 'required'
            )
        );

        $remember = $request->has('remember') ? true : false;

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $remember)) {
            // if (Auth::viaRemember()) {
            //     dd("remembered successfully");
            // } else {
            //     dd("failed to remember");
            // }


            $request->session()->regenerate();

            //return redirect()->intended( 'dashboard' );
            //dd(Auth::user());
            Auth::login(Auth::user());

            // $user = User::all()->where('id', Auth::user()->id)->first();
            // event(new UserSuccessfulLogin($user));
            event( new UserSuccessfulLogin( Auth::user() ) );


            //return redirect('/');
            return redirect()->route('dashboard');
        } else {
            return back()->withErrors(array(
                'msg' => 'Email i lozinka nisu valjani.'
            ));
        }
    }

    public function logout(Request $request)
    {
        // Auth::logout();
        // return redirect( '/login' );
        return redirect('/')->with(Auth::logout());
    }
}
