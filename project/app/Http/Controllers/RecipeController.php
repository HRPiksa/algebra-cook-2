<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\MeasurementUnit;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RecipeController extends Controller
{
    public function __construct()
    {
        return $this->middleware( 'auth' )->except( 'show' );
        //return $this->middleware( 'auth', ['except' => ['index']] );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( Gate::allows( array( 'manage-users', 'manage-recipes' ) ) ) {
            $recipes = Recipe::all();
        } else {
            $user = User::find( Auth::user()->id );
            $recipes = $user->recipes()->orderBy( 'title' )->get();
        }
        return view( 'recipes.index' )->with( array( 'recipes' => $recipes ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ingredients_list = Ingredient::pluck( 'title' )->toJson();
        $units_list = MeasurementUnit::pluck( 'short_title' )->toJson();

        return view( 'recipes.create' )->with( array( 'ingredients_list' => $ingredients_list, 'units_list' => $units_list ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        //dd( $request );
        $request->validate(
            array(
                'title'       => 'required',
                'description' => 'required'
            )
        );

        $path = '';

        if ( $request->hasFile( 'image' ) ) {
            if ( $request->file( 'image' )->isValid() ) {
                // Sada smo sigurni da datoteka postoji

                // $path = $request->image->path();

                // $extension = $request->image->extension();

                $request->validate( array(
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ) );

                // Funkcija getClientOriginalName() - dohvaća izvorni naziv slike
                $file_name = $request->file( 'image' )->getClientOriginalName();
                $file_folder = 'images/' . Auth::user()->id;

                $path = $request->image->storeAs( $file_folder, $file_name, 'public' );
            }
        }

        //dd( $request , $path, Auth::user(), User::all()->where('id', Auth::user()->id)->first());

        // Sve je u redu, validacija je u redu -> spremi u bazu!
        $recipe = Recipe::create(
            array(
                'title'             => trim( $request->input( 'title' ) ),
                'short_description' => trim( $request->input( 'short_description' ) ),
                'description'       => trim( $request->input( 'description' ) ),
                'image'             => trim( $path ),
                'public'            => $request->input( 'public' )
            )
        );

        if ( isset( $recipe ) ) {
            $recipe->users()->attach( Auth::user() );

            for ( $i = 0; $i < count( $request->ingredient ); ++$i ) {
                $ingredient_id = Ingredient::firstorCreate( array( 'title' => $request->ingredient[$i] ) )->id;

                $unit_id = MeasurementUnit::firstorCreate( array( 'title' => $request->unit[$i], 'short_title' => $request->unit[$i] ) )->id;

                $quantity = $request->quantity[$i];

                $recipe->ingredients()->attach( $ingredient_id, array( 'quantity' => $quantity, 'measurement_unit_id' => $unit_id ) );
            }

            return redirect()->route( 'recipes.index' );
        } else {
            return redirect()->back()->withErrors( array( 'msg' => 'Greška kod unosa' ) );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        $recipe = Recipe::find( $id );

        if ( $recipe->public != 1 && Auth::check() == false ) {
            return redirect()->route( 'login' );
        }

        return view( 'recipes.show' )->with( array( 'recipe' => $recipe ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        //
    }
}
