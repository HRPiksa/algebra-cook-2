@extends('layouts.main')

@section('title', 'List of all roles')

@section('content')

<div class="card">
    <div class="card-header">
        Dobro došli <b>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</b>, na Algebra Cook administracijsko
        sučelje
    </div>

    <div class="card-body">
        <h4 style="text-align: left"><u> List of all roles </u></h4>

        @can('create-roles', User::class)
        <div>
            <a href="{{route('roles.create')}}" class="btn btn-success">Add new role</a>
        </div>

        <br>
        @endcan

        <table class="table">
            <thead>
                <tr class="d-flex">
                    <th class="col-1">#</th>
                    <th class="col-2">Name</th>
                    <th class="col-6">Permissions</th>
                    <th class="col-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr class="d-flex">
                    <td class="col-1">{{ $role->id }}</td>
                    <td class="col-2">{{ $role->name }}</td>
                    <td class="col-6">
                        {{ implode(', ', $role->permissions()->pluck('name')->toArray()) }}
                    </td>

                    @canany(['edit-roles', 'delete-roles'], User::class)
                    <td class="col-3">
                        @can('edit-users', User::class)
                        <a href="{{route('roles.edit', ['role' => $role->id])}}" class="btn btn-primary">Edit</a>
                        @endcan
                        @can('delete-users', User::class)
                        <a href="{{route('roles-delete', ['role' => $role->id])}}" class="btn btn-warning">Delete</a>
                        @endcan
                    </td>
                    @endcanany
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection