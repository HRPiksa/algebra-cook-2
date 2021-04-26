@extends('layouts.main')

@section('title', 'Delete role')

@section('content')

<div>
    <a href="{{ route('roles.index') }}"> &lt;&lt;&lt; Back</a> 
</div>

<div>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div>
    <form action="{{ route('roles.destroy', ['role' => $role->id ]) }}" method="POST">
        @method("DELETE")

        @csrf

        <label>Are you sure you want to remove the role?</label>

        <div class="row">
            <div class="col-md-6">
                <input type="submit" class="btn btn-danger" value="YES">
            </div>

            <div class="col-md-6">
                <a href="{{ route('roles.index') }}" class="btn btn-warning">NO</a>
            </div>
        </div>
    </form>
</div>

@endsection