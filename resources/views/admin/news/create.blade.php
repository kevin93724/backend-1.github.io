@extends('layouts/app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">

@endsection


@section('content')

<div class="container">
<h1>新增最新消息</h1>


<form method="POST" action="/home/news/store" enctype="multipart/form-data">
    @csrf
  <div class="form-group">
    <label for="img">主要圖片上傳</label>
    <input type="file" class="form-control" id="img" name="image" >
  </div>
  <div class="form-group">
    <label for="news_imgs">多張圖片上傳</label>
    <input type="file" class="form-control" id="news_imgs" name="news_imgs[]"  multiple>
  </div>
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title" required>
  </div>
  <div class="form-group">
    <label for="content">Content</label>
    <textarea type="text" class="form-control summernote" id="content" name="content"></textarea>
  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>


</div>

@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

<script>
        $('.summernote').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            // maxHeight: null,             // set maximum height of editor
            // focus: true                  // set focus to editable area after initializing summernote
        });
</script>


@endsection

