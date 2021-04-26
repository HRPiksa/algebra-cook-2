{{-- Korak 1: odabir glavnog layouta (kostura dizajna stranice) --}}
@extends('layouts.frontend.main')

{{-- Korak 2: Definiranje naslova početne stranice --}}
{{-- Nije potreban @endsection - on je potreban za html --}}
@section('title', 'Algebra Cook - Home page')

{{-- Korak 3: Dizajn početne stranice --}}
@section('content')

<div class="container">
    {{$page->content}}
</div>

@endsection