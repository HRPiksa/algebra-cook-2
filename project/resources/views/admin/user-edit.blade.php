@extends('layouts.main')

@section('title', 'User edit')

@section('content')

<h4 style="text-align: left"><u> Edit User </u></h4>

<div>
    <a href="{{route('dashboard')}}"> &lt;&lt;&lt; Back</a>
</div>

<hr>

<div class="row justify-content-md-center">
    <div class="col-md-12">
        <form action="{{route('user-update', ['user' => $user->id])}}" method="POST">
            @csrf

            <div class="form-group col-md-4">
                <label>Ime</label>
                <input type="text" name="firstname" class="form-control" value="{{$user->firstname}}">
            </div>
            <div class="form-group col-md-4">
                <label>Ime</label>
                <input type="text" name="lastname" class="form-control" value="{{$user->lastname}}">
            </div>
            <div class="form-group col-md-4">
                <label>Ime</label>
                <input type="email" name="email" class="form-control" value="{{$user->email}}">
            </div>

            <div class="form-group col-md-4">
                @foreach ($roles as $role)
                <div class="form-check">
                    <input type="checkbox" name="roles[]" value="{{$role->id}}"
                        @if($user->roles->pluck('id')->contains($role->id))
                    checked
                    @endif
                    @if ($user->roles->pluck('name')->contains('admin'))
                    @if ($role->name == 'admin')
                    hidden
                    @endif
                    @endif
                    >
                    <label>{{$role->name}}</label>
                </div>
                @endforeach
            </div>

            <div class="form-group col-md-4">
                <input type="submit" class="btn btn-success" value="Update user">
            </div>
        </form>
    </div>
</div>
@endsection