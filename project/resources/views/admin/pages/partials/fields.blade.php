@if (!$errors->isEmpty())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $message)
        <li>{{$message}}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" class="form-control" id="title" value="{{ $model->title }}">
</div>

<div class="form-group">
    <label for="url">URL</label>
    <input type="text" name="url" class="form-control" id="url" value="{{ $model->url }}">
</div>

<div class="form-group row">
    <div class="col-md-12">
        <label for="">Order</label>
    </div>
    <div class="col-md-3">
        <select name="order" id="order" class="form-control">
            <option value=""></option>
            <option value="before">Before</option>
            <option value="after">After</option>
            <option value="child">Child Of</option>
        </select>
    </div>
    <div class="col-md-8">
        <select name="orderPage" id="orderPage" class="form-control">
            <option value=""></option>
            @foreach ($orderPages as $page)
            <option value="{{$page->id}}">{!! $page->present()->paddedTitle !!}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label for="content">Content</label>
    <textarea type="text" name="content" class="form-control" id="content">{{$model->content}}</textarea>
</div>

<div class="form-group">
    <input type="submit" class="btn btn-success" value="Subbmit">
</div>