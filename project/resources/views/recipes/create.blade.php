@extends('layouts.main')

@section('title', 'Add new recipe')

@section('content')

<div>
    <a href="{{route('recipes.index')}}"> &lt;&lt;&lt; Back</a>
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
    <div class="col-md-6">
        <div class="controls">
            <form action="{{ route('recipes.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Short title</label>
                    <textarea id="tiny2" name="short_description" cols="30" rows="3" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="">Description</label>
                    <textarea id="description" name="description" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Publish</label>
                    <select name="public" id="" class="form-control">
                        <option value="0">Ne</option>
                        <option value="1">Da</option>
                    </select>
                </div>

                <label for="">Ingredients</label>
                <div class="form-group row entry">
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" name="quantity[]" placeholder="Quantity" id="recipe-quantity"
                                    class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="unit[]" placeholder="Unit" class="form-control recipe-unit">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <input type="text" name="ingredient[]" class="recipe-ingredient form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-success btn-add" type="button">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" value="Create recipe" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<script src="//cdn.ckeditor.com/4.5.9/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace( 'description' );
</script>

{{-- <script src="https://cdn.tiny.cloud/1/jsoyl1dlo0yr863875nqw38anmeunxu2msbmpfyj56wj0fug/tinymce/5/tinymce.min.js"
    referrerpolicy="origin">
</script>

<script>
    tinymce.init({
      selector: 'textarea:not(#tiny2)',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
   });
</script> --}}

@endsection

@section('after-script')
<script>
    $(function() {
            var availableTags = {!! $units_list !!};
            $( ".recipe-unit" ).autocomplete({
                source: availableTags
            });
        });
        $(function() {
            var availableTags = {!! $ingredients_list !!};
            $( ".recipe-ingredient" ).autocomplete({
                source: availableTags
            });
        });

        $(function()
        {
            $(document).on('click', '.btn-add', function(e)
            {
                e.preventDefault();

                var controlForm = $('.controls form:first'),
                        currentEntry = $(this).parents('.entry:first'),
                        newEntry = $(currentEntry.clone()).insertAfter(currentEntry);

                newEntry.find('input').val('');
                controlForm.find('.entry:not(:last) .btn-add')
                        .removeClass('btn-add').addClass('btn-remove')
                        .removeClass('btn-success').addClass('btn-danger')
                        .html('<span class="fa fa-minus"></span>');
                var availableTags = {!! $ingredients_list !!};
                controlForm.find(".recipe-ingredient").autocomplete({
                   source: availableTags
                });
                var availableTags = {!! $units_list !!};
                controlForm.find(".recipe-unit").autocomplete({
                    source: availableTags
                });

            }).on('click', '.btn-remove', function(e)
            {
                $(this).parents('.entry:first').remove();

                e.preventDefault();
                return false;
            });
        });
        {{--$(function() {--}}
            {{--var availableTags = {!! $ingredients_list !!};--}}
            {{--$( '#recipe-ingredient:last' ).autocomplete({--}}
                    {{--source: availableTags--}}
                {{--});--}}
            {{--});--}}
</script>
@endsection