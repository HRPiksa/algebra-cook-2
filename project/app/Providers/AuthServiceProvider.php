<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = array(
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    );

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //

        // Gate::define('manage-users', function($user){
        //     // Definiramo uvjete za ovu privilegiju
        //     return $user->has_any_role(['admin', 'editor']);
        // });

        // Korak 1. - dohvatimo sve premisije iz tablice baze podataka
        // Korak 2. - za svaku iteraciju premisije kreiramo Gate za autorizaciju
        // Korak 3. - unutar svakog Gate-a, provjeri ima li prijavljeni korisnik rolu koja podržava tu premisiju

        // get() dohvaća sve prenisije iz tablice premissions
        // napravi foreach dohvaćene kolekcije podataka
        Permission::get()->map(function ($permission) {
            Gate::define(
                $permission->slug,
                function ($user) use ($permission) {
                    // Programska logika

                    // echo '<pre>';
                    // var_dump($user->id);
                    // var_dump($permission->slug);
                    // var_dump($user->has_permission_to($permission));
                    // echo '</pre>';
                    // die();

                    return $user->has_permission_to($permission);
                }
            );
        });
    }
}
