<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'ingredients' )->delete();

        Ingredient::create( array(
            'title' => 'Voda'
        ) );

        Ingredient::create( array(
            'title' => 'Sol'
        ) );

        Ingredient::create( array(
            'title' => 'Šećer'
        ) );

        Ingredient::create( array(
            'title' => 'Jaje'
        ) );

        Ingredient::create( array(
            'title' => 'Brašno'
        ) );

        Ingredient::create( array(
            'title' => 'Kvasac'
        ) );

        Ingredient::create( array(
            'title' => 'Majoneza'
        ) );

        Ingredient::create( array(
            'title' => 'Senf'
        ) );

        Ingredient::create( array(
            'title' => 'Ulje'
        ) );
    }
}
