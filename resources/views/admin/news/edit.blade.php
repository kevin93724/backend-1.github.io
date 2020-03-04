@extends('layouts/app')



@section('content')

<div class="container">
<h1>新增最新消息</h1>


<form method="POST" action="/home/news/update/{{$news->id}}">
    @csrf
  <div class="form-group">
    <label for="img">IMG</label>
    <input type="text" class="form-control" id="img" name="image" value="{{$news->image}}">
  </div>
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="{{$news->title}}">
  </div>
  <div class="form-group">
    <label for="title">Sort</label>
    <input type="number" class="form-control" id="sort" name="sort" value="{{$news->sort}}">
  </div>

  <div class="form-group">
    <label for="content">Content</label>

    <input type="text" class="form-control" id="content" name="content" value="{{$news->content}}">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>


</div>

@endsection
