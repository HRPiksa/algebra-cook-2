@extends('layouts.main')

@section('title', 'Create new role')

@section('content')

<h4 style="text-align: left"><u> Create Role </u></h4>

<div>
    <a href="{{ route('roles.index') }}"> &lt;&lt;&lt; Back </a>
</div>

<hr>

<div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach </ul>
    </div>
    @endif
</div>

<div class="row justify-content-md-center">
    <div class="col-md-8">
        <form action="{{route('roles.store')}}" method="POST">
            @csrf

            <div class="form-group">
                <label for="">Role name</label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="form-group">
                <label for="">Permissions</label>

                <hr>

                <div class="row">
                    <div class="col-md-3">
                        <label for=""><u> Roles permissions </u></label>
                        @foreach ($permissions['roles'] as $permission)
                        <div class="form-check">
                            <input type="checkbox" name="permissions[]" value="{{$permission->id}}">
                            <label for="">{{$permission->name}}</label>
                        </div>
                        @endforeach
                    </div>

                    <div class="col-md-3">
                        <label for="">Users permissions</label>
                        @foreach ($permissions['users'] as $permission)
                        <div class="form-check">
                            <input type="checkbox" name="permissions[]" value="{{$permission->id}}">
                            <label for="">{{$permission->name}}</label>
                        </div>
                        @endforeach
                    </div>

                    <div class="col-md-3">
                        <label for="">Pages permissions</label>
                        @foreach ($permissions['pages'] as $permission)
                        <div class="form-check">
                            <input type="checkbox" name="permissions[]" value="{{$permission->id}}">
                            <label for="">{{$permission->name}}</label>
                        </div>
                        @endforeach
                    </div>

                    <div class="col-md-3">
                        <label for="">Recipes permissions</label>
                        @foreach ($permissions['recipes'] as $permission)
                        <div class="form-check">
                            <input type="checkbox" name="permissions[]" value="{{$permission->id}}">
                            <label for="">{{$permission->name}}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Create role" />
            </div>
        </form>
    </div>
</div>

@endsection