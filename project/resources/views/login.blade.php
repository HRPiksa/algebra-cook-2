{{-- 1. korak - odabir layouta --}}
@extends('layouts.main')

{{-- 2. korak - postavi naslov stranice --}}
@section('title', 'Login')

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
        <form action="{{route('login')}}" method="post">
            <!-- zaštita -->
            @csrf

            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="form-group">
                <label for="">Lozinka</label>
                <input type="password" name="password" class="form-control">
            </div>

            {{-- <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div> --}}

            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Prijavi se">
            </div>
        </form>
    </div>
</div>

@endsection