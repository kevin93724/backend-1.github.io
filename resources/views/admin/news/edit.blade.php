@extends('layouts/app')



@section('content')

<div class="container">
<h1>新增最新消息</h1>


<form method="POST" action="/home/news/update/{{$news->id}}" enctype="multipart/form-data">
    @csrf
  <div class="form-group">
    <label for="img">現有主要圖片</label>
    <img class="mg-fluid" width="250" src="{{$news->image}}" alt="">
  </div>
  {{-- multi-fig --}}
  <div class="form-group">
    <label for="title">重新上傳主要圖片(建議圖片尺寸寬400px x 高200px)</label>
    <input type="file" class="form-control" id="img" name="img">
</div>
<hr>
<div class="row">
    現有多張圖片組
    @foreach ($news->news_imgs as $item)
    <div class="col-2">
        <div class="news_img_card" data-newsimgid="{{$item->id}}">
            <button type="button" class="btn btn-danger" data-newsimgid="{{$item->id}}">X</button>
            <img class="img-fluid" src="{{$item->image_url}}" alt="">
            <input class="form-control" type="text" value="{{$item->sore}}">
        </div>
    </div>
    @endforeach
</div>
<div class="form-group">
    <label for="title">新增多張圖片組(建議圖片尺寸寬400px x 高200px)</label>
    <input type="file" class="form-control" id="news_imgs" name="news_imgs[]" required multiple>
</div>
<hr>
  {{-- multi-fig --}}



  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="{{$news->title}}">
  </div>
  <div class="form-group">
    <label for="sort">權重(數字越大的排在越前面)</label>
    <input type="number" min="0" class="form-control" id="sort" name="sort" value="{{$news->sort}}">
  </div>

  <div class="form-group">
    <label for="content">Content</label>
    <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{$news->content}}</textarea>
    {{-- <input type="text" class="form-control" id="content" name="content" value="{{$news->content}}"> --}}
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>


</div>

@endsection
