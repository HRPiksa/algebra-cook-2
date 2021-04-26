<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'pages' )->delete();
        DB::table( 'users' )->delete();

        // Korak 1 - dohvati role i pohrani ih u varijablu
        $admin_role = Role::where( 'name', 'admin' )->first();
        $editor_role = Role::where( 'name', 'editor' )->first();
        $user_role = Role::where( 'name', 'user' )->first();

        // Korak 2 - kreirajte testne korisnike
        $admin = User::create( array(
            'firstname' => 'Predavac',
            'lastname'  => 'Adminić',
            'email'     => 'admin@email.com',
            'username'  => 'admin',
            'password'  => Hash::make( '1234' )
        ) );

        $editor = User::create( array(
            'firstname' => 'Ana',
            'lastname'  => 'Dizajnerić',
            'email'     => 'ana@email.com',
            'username'  => 'ana',
            'password'  => Hash::make( '1234' )
        ) );

        $user = User::create( array(
            'firstname' => 'Mićo',
            'lastname'  => 'Programerić',
            'email'     => 'mico@email.com',
            'username'  => 'mico',
            'password'  => Hash::make( '1234' )
        ) );

        // Korak 3 - spajanje korisnika s ulogom
        $admin->roles()->attach( $admin_role );
        $editor->roles()->attach( $editor_role );
        $user->roles()->attach( $user_role );
    }
}
