<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view( 'register' );
    }

    public function register( Request $request )
    {
        $request->validate(
            array(
                'firstname' => 'required',
                'lastname'  => 'required',
                'email'     => 'required|email|unique:users,email',
                'username'  => 'required|unique:users,username',
                'password'  => 'required'
            )
        );
        // Sve je u redu, validacija je u redu -> spremi u bazu!
        $user = User::create(
            array(
                'firstname' => trim( $request->input( 'firstname' ) ),
                'lastname'  => trim( $request->input( 'lastname' ) ),
                'username'  => trim( $request->input( 'username' ) ),
                'email'     => strtolower( trim( $request->input( 'email' ) ) ),
                'password'  => bcrypt( $request->input( 'password' ) )
            )
        );

        if ( isset( $user ) ) {
            // Dohvati rolu gdje je njen naziv "user"
            $user_role = Role::where('name', 'user')->first();

            // Zakači rolu na novoregistriranog korisnika
            $user->roles()->attach($user_role);

            // Sve ok unos u bazu je uspio
            return redirect()->route('login');
        } else {
            return redirect()->back()->withErrors( array( 'msg' => 'Greška kod registracije' ) );
        }
    }
}
