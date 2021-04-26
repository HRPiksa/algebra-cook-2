{{-- 1. korak - odabir layouta --}}
@extends('layouts.main')

{{-- 2. korak - postavi naslov stranice --}}
@section('title', 'Register')

{{-- 3. korak - dizajn stranice --}}
@section('content')

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row justify-content-md-center">
    <div class="col-md-4">
        <form action="{{route('register')}}" method="post">
            <!-- zaštita -->
            @csrf

            <div class="form-group">
                <label for="">Ime</label>
                <input type="text" name="firstname" class="form-control">
            </div>

            <div class="form-group">
                <label for="">Prezime</label>
                <input type="text" name="lastname" class="form-control">
            </div>

            <div class="form-group">
                <label for="">Korisničko ime</label>
                <input type="text" name="username" class="form-control">
            </div>

            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="form-group">
                <label for="">Lozinka</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Registriraj se">
            </div>
        </form>
    </div>
</div>

@endsection