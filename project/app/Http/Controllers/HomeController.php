<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if ( Auth::check() ) {
            return redirect()->route( 'recipes.index' );
        } else {
            $recipes = Recipe::all();
            return view( 'home.index')->with(array('recipes' => $recipes));
        }
    }

    public function create()
    {
        return view( 'recipes.create' );
    }

    public function store( Request $request )
    {
        $request->validate(
            array(
                'title'       => 'required',
                'description' => 'required',
                'public'      => 'required'
            )
        );
        // Sve je u redu, validacija je u redu -> spremi u bazu!
        $recipe = Recipe::create(
            array(
                'title'             => trim( $request->input( 'title' ) ),
                'short_description' => trim( $request->input( 'short_description' ) ),
                'description'       => trim( $request->input( 'description' ) ),
                'image'             => trim( $request->input( 'image' ) ),
                'public'            => $request->input( 'public' )
            )
        );

        if ( isset( $recipe ) ) {
            return redirect()->route( 'dashboard' );
        } else {
            return redirect()->back()->withErrors( array( 'msg' => 'Greška kod unosa' ) );
        }
    }

    public function show( $id )
    {
        $recipe = Recipe::with( 'ingredients' )->findorFail( $id );

        return view( 'recipes.show')->with(array('recipe' => $recipe));
    }
}
