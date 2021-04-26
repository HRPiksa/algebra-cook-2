@extends('layouts.main')

@section('title', 'List of recipes')

@section('content')

<div class="card">
    <div class="card-header">
        Welcome <b> {{Auth::user()->firstname }} {{ Auth::user()->lastname}} </b>, view list of recipes
    </div>

    <div class="card-body">
        <h4 style="text-align: left"><u> List of all recipes </u></h4>

        @can('create-recipes', User::class)
        <div>
            <a href="{{ route('recipes.create') }}" class="btn btn-success">Add new recipe</a>
        </div>

        <br>
        @endcan

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Short description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recipes as $recipe)
                <tr>
                    <td>{{$recipe->id}}</td>
                    <td>{{$recipe->title}}</td>
                    <td>{{$recipe->short_description}}</td>
                    <td>{{$recipe->public == 1 ? 'Public' : 'Draft'}}</td>
                    @canany(['edit-recipes', 'delete-recipes'], User::class)
                    <td>
                        <a href="{{route('recipes.show', ['recipe' => $recipe->id])}}" class="btn btn-success">View</a>
                        @can('edit-recipes', User::class)
                        <a href="{{route('recipes.edit', ['recipe' => $recipe->id])}}" class="btn btn-primary">Edit</a>
                        @endcan
                        {{-- @can('delete-recipes', User::class)
                        <a href="{{route('recipe-delete', ['recipe' => $recipe->id])}}" class="btn btn-warning">Delete</a>
                        @endcan --}}
                    </td>
                    @endcanany
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection