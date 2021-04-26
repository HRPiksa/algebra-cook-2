@extends('layouts.main')

@section('title', 'Add new user')

@section('content')

<h4 style="text-align: left"><u> Create User </u></h4>

<div>
    <a href="{{ route('dashboard') }}"> &lt;&lt;&lt; Back</a>
</div>

<hr>

<div>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="row justify-content-md-center">
    <div class="col-md-4">
        <form action="{{ route('user-store') }}" method="post">
            @csrf

            <div class="form-group">
                <label>Ime</label>
                <input type="text" name="firstname" class="form-control" value="{{ old('firstname') }}" />
            </div>
            <div class="form-group">
                <label>Prezime</label>
                <input type="text" name="lastname" class="form-control" value="{{ old('lastname') }}" />
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" />
            </div>
            <div class="form-group">
                <label>Korisničko ime</label>
                <input type="text" name="username" class="form-control" value="{{ old('username') }}" />
            </div>
            <div class="form-group">
                <label>Lozinka</label>
                <input type="password" name="password" class="form-control" />
            </div>
            <div class="form-group">
                <label>Uloge</label>
                @foreach($roles as $role)
                <div class="form-check">
                    <input type="checkbox" name="roles[]" value={{ $role->id }}>
                    <label>{{ $role->name }}</label>
                </div>
                @endforeach
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Create user" />
            </div>
        </form>
    </div>
</div>

@endsection