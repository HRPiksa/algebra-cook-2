<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\MeasurementUnit;
use App\Models\Recipe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeIngredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recipe_ingredients')->delete();

        $recipe = Recipe::orderBy('id', 'asc')->first();

        $ingredient = array(
            Ingredient::where('title', 'Ulje')->first(),
            Ingredient::where('title', 'Jaje')->first(),
            Ingredient::where('title', 'Sol')->first(),
        );

        $unit = array(
            MeasurementUnit::where('short_title', 'ml')->first(),
            MeasurementUnit::where('short_title', 'kom')->first(),
            MeasurementUnit::where('short_title', 'g')->first()
        );

        $quantity = array(6, 3, 2);

        for ($x = 0; $x < 3; $x++) {
            DB::table('recipe_ingredients')->insert(
                array(
                    'recipe_id'           => $recipe->id,
                    'ingredient_id'       => $ingredient[$x]->id,
                    'quantity'            => $quantity[$x],
                    'measurement_unit_id' => $unit[$x]->id
                )
            );
        }

        $recipe = Recipe::orderBy('id', 'asc')->skip(1)->first();

        $ingredient = array(
            Ingredient::where('title', 'Ulje')->first(),
            Ingredient::where('title', 'Jaje')->first(),
            Ingredient::where('title', 'Sol')->first()
        );

        $unit = array(
            MeasurementUnit::where('short_title', 'ml')->first(),
            MeasurementUnit::where('short_title', 'kom')->first(),
            MeasurementUnit::where('short_title', 'g')->first()
        );

        $quantity = array(0.1, 2, 5);

        for ($x = 0; $x < 3; $x++) {
            DB::table('recipe_ingredients')->insert(
                array(
                    'recipe_id'           => $recipe->id,
                    'ingredient_id'       => $ingredient[$x]->id,
                    'quantity'            => $quantity[$x],
                    'measurement_unit_id' => $unit[$x]->id
                )
            );
        }

        $recipe = Recipe::orderBy('id', 'asc')->skip(2)->first();

        $ingredient = array(
            Ingredient::where('title', 'Brašno')->first(),
            Ingredient::where('title', 'Ulje')->first(),
            Ingredient::where('title', 'Jaje')->first(),
            Ingredient::where('title', 'Sol')->first()
        );

        $unit = array(
            MeasurementUnit::where('short_title', 'kg')->first(),
            MeasurementUnit::where('short_title', 'ml')->first(),
            MeasurementUnit::where('short_title', 'kom')->first(),
            MeasurementUnit::where('short_title', 'g')->first()
        );

        $quantity = array(0.5, 10, 2, 5);

        for ($x = 0; $x < 4; $x++) {
            DB::table('recipe_ingredients')->insert(
                array(
                    'recipe_id'           => $recipe->id,
                    'ingredient_id'       => $ingredient[$x]->id,
                    'quantity'            => $quantity[$x],
                    'measurement_unit_id' => $unit[$x]->id
                )
            );
        }
    }
}
