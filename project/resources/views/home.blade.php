{{-- Korak 1: odabir glavnog layouta (kostura dizajna stranice) --}}
@extends('layouts.main')

{{-- Korak 2: Definiranje naslova početne stranice --}}
{{-- Nije potreban @endsection - on je potreban za html --}}
@section('title', 'Algebra Cook - početna')

{{-- Korak 3: Dizajn početne stranice --}}
@section('content')

<h1>Dobro došli na stranice razvoja Algebra Cook projekta</h1>

<hr>

<div>
    <p>
        {{Auth::user()}}
    </p>
</div>

@endsection