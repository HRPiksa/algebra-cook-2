@extends('layouts.main')

@section('title', 'Brisanje korisnika')

@section('content')

<div>
    <form action="{{route('user-destroy', ['user' => $user->id])}}" method="POST">
        @csrf

        <label for="">Jeste li sigorni da želite obrisati korisnika ?</label>
        <div class="row">
            <div class="col-md-6">
                <input type="submit" class="btn btn-danger" value="YES">
            </div>
            <div class="col-md-6">
                <a href="{{route('dashboard')}}" class="btn btn-warning">NO</a>
            </div>
        </div>
    </form>
</div>

@endsection