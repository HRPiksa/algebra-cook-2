@extends('layouts.main')

@section('title', 'Create new page')

@section('content')

<div class="container-fluid">
    <h4 style="text-align: left"><u> Create Page </u></h4>

    <div>
        <a href="{{ route('pages.index') }}">&lt;&lt;&lt; Back </a>
    </div>

    <hr>

    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <form action="{{route('pages.store')}}" method="POST">
                @csrf

                @include('admin.pages.partials.fields')
            </form>
        </div>
    </div>
</div>

@endsection