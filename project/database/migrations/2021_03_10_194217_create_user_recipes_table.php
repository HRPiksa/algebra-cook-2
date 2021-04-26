<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_recipes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger( 'recipe_id' );
            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->onUpdate('cascade')->onDelete('restrict');
            $table->foreign( 'recipe_id' )->references( 'id' )->on( 'recipes' )->onUpdate('cascade')->onDelete('restrict');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_recipes');
    }
}
