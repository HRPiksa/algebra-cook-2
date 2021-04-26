{{-- Korak 1: odabir glavnog layouta (kostura dizajna stranice) --}}
@extends('layouts.frontend.main')

{{-- Korak 2: Definiranje naslova početne stranice --}}
{{-- Nije potreban @endsection - on je potreban za html --}}
@section('title', 'Algebra Cook - Home page')

{{-- Korak 3: Dizajn početne stranice --}}
@section('content')

<h2>Algebra Cook project</h2>

<hr>

<div class="container">
    @foreach(array_chunk($recipes->all(),4) as $recipesRow)
    <div class="card-deck-wrapper">
            <div class="card-deck">
                @foreach($recipesRow as $recipe)
                <div class="card">
                    <a href="{{route('recipes.show', ['recipe' => $recipe->id])}}">
    <img class="card-img-top" src="{{url($recipe->image)}}" alt="{{ $recipe->title }}">
    {{-- <div class="card-block">
        <h6><a href="/recipes/{{$recipe->id}}/">{{ $recipe->title }}</a></h6>
        <div class="pull-right"></div>
    </div>
    </a>
    <div class="card-footer">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Rating: <input type="hidden" class="rating" data-fractions="2"
                    value="{{$recipe->rating}}" data-readonly />
                <a href="/recipes/toggle_favourite/{{$recipe->id}}" class="pull-lg-right">
                    @if($recipe->favourite)
                    <i class="fa fa-heart favourite" aria-hidden="true"></i>
                    @else
                    <i class="fa fa-heart-o favourite" aria-hidden="true"></i>
                    @endif
                </a>
            </li>
        </ul>
    </div> --}}
</div>

@endforeach
</div>
</div>
@endforeach
</div>

@endsection