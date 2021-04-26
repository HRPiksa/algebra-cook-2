<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_ingredients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'recipe_id' );
            $table->unsignedBigInteger( 'ingredient_id' );
            $table->decimal('quantity', 9, 2);
            $table->unsignedBigInteger( 'measurement_unit_id' );
            $table->foreign( 'recipe_id' )->references( 'id' )->on( 'recipes' )->onUpdate( 'cascade' )->onDelete( 'restrict' );
            $table->foreign( 'ingredient_id' )->references( 'id' )->on( 'ingredients' )->onUpdate( 'cascade' )->onDelete( 'restrict' );
            $table->foreign( 'measurement_unit_id' )->references( 'id' )->on( 'measurement_units' )->onUpdate( 'cascade' )->onDelete( 'restrict' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_ingredients');
    }
}
