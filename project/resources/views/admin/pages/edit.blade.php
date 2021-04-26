@extends('layouts.main')

@section('title', 'Edit page')

@section('content')

<div class="container-fluid">
    <h4 style="text-align: left"><u> Edit Page </u></h4>

    <div>
        <a href="{{ route('pages.index') }}"> &lt;&lt;&lt; Back</a>
    </div>

    <hr>

    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <form method="POST" action="{{ route('pages.update', ['page' => $model->id]) }}">
                @method('PUT')

                @csrf

                @include('admin.pages.partials.fields')
            </form>
        </div>
    </div>
</div>

@endsection