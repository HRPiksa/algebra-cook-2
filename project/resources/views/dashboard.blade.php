@extends('layouts.main')

@section('title', 'Dobro došli - ' . Auth::user()->firstname . ' ' . Auth::user()->lastname)

@section('content')

@can('manage-users', User::class)
{{-- Ovaj korisnik ima ulogu čija permisija dozvoljava pregled korisnika --}}
@include('admin.index')
@else
{{-- Ovaj korisnik nema ulogu čija permisija dozvoljava pregled korisnika --}}
@include('user.index')@endcan

@endsection