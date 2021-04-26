@extends('layouts.main')

@section('title', 'List of all pages')

@section('content')

<div class="card">
    <div class="card-header">
        Dobro došli <b>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</b>, na Algebra Cook administracijsko
        sučelje
    </div>

    <div class="card-body">
        <div class="container-fluid">
            <h4 style="text-align: left"><u> List of all pages </u></h4>

            @can('create-pages', User::class)
            <div>
                <a href="{{route('pages.create')}}" class="btn btn-success">Add new page</a>
            </div>

            <br>
            @endcan

            @if (session('status'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                {{ session('status')}}
            </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        {{-- <th>#</th> --}}
                        <th>Title</th>
                        <th>URL</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pages as $page)
                    <tr>
                        {{-- <td>{{ $page->id }}</td> --}}
                        <td>{!! $page->present()->paddedTitle !!}</td>
                        <td>{{ $page->url }}</td>

                        @canany(['edit-pages', 'delete-pages'], User::class)
                        <td>
                            @can('edit-users', User::class)
                            <a href="{{route('pages.edit', ['page' => $page->id])}}" class="btn btn-primary">Edit</a>
                            @endcan
                            @can('delete-users', User::class)
                            <a href="{{route('pages-delete', ['page' => $page->id])}}"
                                class="btn btn-warning">Delete</a>
                            @endcan
                        </td>
                        @endcanany
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection