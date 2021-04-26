<?php

namespace Database\Seeders;

use App\Models\MeasurementUnit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeasurementUnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'recipe_ingredients' )->delete();
        DB::table( 'measurement_units' )->delete();

        MeasurementUnit::create( array(
            'title'       => 'Litra',
            'short_title' => 'l'
        ) );

        MeasurementUnit::create( array(
            'title'       => 'Kilogram',
            'short_title' => 'kg'
        ) );

        MeasurementUnit::create( array(
            'title'       => 'Metar',
            'short_title' => 'm'
        ) );

        MeasurementUnit::create( array(
            'title'       => 'Mililitar',
            'short_title' => 'ml'
        ) );

        MeasurementUnit::create( array(
            'title'       => 'Decilitar',
            'short_title' => 'dl'
        ) );

        MeasurementUnit::create( array(
            'title'       => 'Gram',
            'short_title' => 'g'
        ) );

        MeasurementUnit::create( array(
            'title'       => 'Komad',
            'short_title' => 'kom'
        ) );
    }
}
