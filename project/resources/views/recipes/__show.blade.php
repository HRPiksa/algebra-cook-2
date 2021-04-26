@extends('layouts.main')

@section('title', $recipe->title)

@section('content')

<div class="row">
    <div class="col-md-4">
        @if(!empty($recipe->image))
        <img src="{{asset('storage/' . $recipe->image)}}" alt="{{$recipe->title}}" width="200">
        @endif
    </div>

    <div class="col-md-6 text-left">
        <h4>{{$recipe->title}}</h4>

        <hr>

        {{$recipe->description}}
    </div>
</div>

@endsection