<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        return $this->middleware( 'auth' );
    }

    public function index()
    {
        $all_users = array();
        if ( Gate::allows( 'manage-users' ) ) {
            $all_users = User::all();
        }
        //return view('dashboard', array('all_users' => $all_users));
        return view( 'dashboard' )->with( array( 'all_users' => $all_users ) );
    }

    // public function logout(){
    //     //
    // }

    public function create( Request $request )
    {

        $roles = Role::all();

        return view( 'admin.user-create' )->with( array('roles' => $roles, 'request' => $request) );
    }

    public function store( Request $request )
    {
        $request->validate( array(
            'firstname' => 'required',
            'lastname'  => 'required',
            'email'     => 'required|email|unique:users,email',
            'username'  => 'required|unique:users,username',
            'password'  => 'required',
            'roles'     => 'required'
        ) );

        $user = User::create( array(
            'firstname' => trim( $request->input( 'firstname' ) ),
            'lastname'  => trim( $request->input( 'lastname' ) ),
            'username'  => trim( $request->input( 'username' ) ),
            'email'     => strtolower( $request->input( 'email' ) ),
            'password'  => Hash::make( $request->input( 'password' ) )
        ) );

        if ( isset( $user ) ) {
            $user->roles()->sync( $request->input( 'roles' ) );

            return redirect()->route( 'dashboard' );
        } else {
            return back()->withErrors( array('error', 'Unos korisnika nije uspio!') );
        }
    }

    // GET - Ruta za ažuriranje korisnika - /admin/user/edit$id
    // HTML forma za ažuriranje
    public function edit( User $user )
    {
        // Dohvati popis svih uloga
        $roles = Role::all();

        // Prikaži  view i prenesi podatke o korisniku i ulogama
        return view( 'admin.user-edit' )->with(
            array(
                'roles' => $roles,
                'user'  => $user
            )
        );
    }

    // POST - Ruta za ažuriranje korisnika i uloga u bazi
    public function update( Request $request, User $user )
    {
        //DZ - kreirati proces validacije

        // Korak 2 - sinkroniziraj odabrane uloge s korisnikom u tablici user_role
        $user->roles()->sync( $request->roles );

        // korak 3 - ažuriraj podatke o korisniku
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;

        $user->save();

        return redirect()->route( 'dashboard' );
    }

    // Ruta za brisanje korisnika - /admin/user/delete/$id
    // HTML forma za brisanje
    public function delete( User $user )
    {
        return view( 'admin.user-delete' )->with(
            array(
                'user' => $user
            )
        );
    }

    public function destroy( User $user )
    {
        // Korak 1. - ukloniti sve uloge za korisnika
        $user->roles()->detach();

        // Korak 2. - uklanjamo korisnika iz tablice users
        $user->delete() ;

        return redirect()->route('dashboard');
    }
}
