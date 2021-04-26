<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'recipe_ingredients' )->delete();
        DB::table( 'recipes' )->delete();

        Recipe::create( array(
            'title'       => 'Kajgana',
            'short_description'       => 'Kajgana',
            'description' => 'U tavu uliti ulje ...',
            'image' => 'files/photos/1.png'
        ) );

        Recipe::create( array(
            'title'       => 'Pečeni kruh',
            'short_description'       => 'Pečeni kruh',
            'description' => 'U pekaču kruha ...',
            'image' => 'files/photos/2.png'
        ) );

        Recipe::create( array(
            'title'       => 'Palačinke',
            'short_description'       => 'Palačinke',
            'description' => 'U posudi izmješati ...',
            'image' => 'files/photos/3.png'
        ) );
    }
}
