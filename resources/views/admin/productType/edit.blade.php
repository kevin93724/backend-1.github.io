@extends('layouts/app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
<style>
    .news_img_card .btn-danger {
        position: absolute;
        top: 0px;
        right: 15px;
        border-radius: 50%;
    }
</style>
@endsection


@section('content')

<div class="container">
<h1>新增最新消息</h1>


<form method="POST" action="/home/productType/update/{{$product_types->id}}" enctype="multipart/form-data">
    @csrf
    dd({{$product_types}})
    dd({{$product_types->types}})
  {{-- <div class="form-group">
    <label for="img">現有主要圖片</label>
    <img class="mg-fluid" width="250" src="{{$news->image}}" alt="">
  </div>

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
            <input class="form-control" type="text" value="{{$item->sort}}" onchange="ajax_post_sort(this,{{$item->id}})">
        </div>
    </div>
    @endforeach
</div>
<div class="form-group">
    <label for="img">新增多張圖片組(建議圖片尺寸寬400px x 高200px)</label>
    <input type="file" class="form-control" id="news_imgs" name="news_imgs[]" multiple>
</div>
<hr> --}}



  <div class="form-group">
    <label for="types">types</label>
    <input type="text" class="form-control" id="types" name="types" value="{{$product_types->types}}">
  </div>
  <div class="form-group">
    <label for="sort">權重(數字越大的排在越前面)</label>
    <input type="number" min="0" class="form-control" id="sort" name="sort" value="{{$product_types->sort}}">
  </div>

  {{-- <div class="form-group">
    <label for="content">Content</label>
    <textarea type="text" class="form-control summernote" name="content" id="content" cols="30" rows="10">{!!$news->content!!}</textarea>

  </div> --}}

  <button type="submit" class="btn btn-primary">Submit</button>
</form>


</div>

@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

<script>
    $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.news_img_card .btn-danger').click(function(){

            var newimgid = this.getAttribute('data-newsimgid')


            $.ajax({
                url: "/home/ajax_delete_news_imgs",    //來自web.php設定
                method: 'post',
                data: {
                    newsimgid: newimgid,
                },
                success: function(result){
                    $(`.news_img_card[data-newsimgid=${newimgid}]`).remove();
                    // console.log(result);
                }
            });

        });


        function ajax_post_sort(element,img_id){
            var img_id;
            var sort_value = element.value;

            $.ajax({
                url: "/home/ajax_post_sort",    //來自web.php設定
                method: 'post',
                data: {
                    img_id: img_id,
                    sort_value:sort_value
                },
                success: function(result){

                    // console.log(result);
                }
            });
        }
        $('.summernote').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            // maxHeight: null,             // set maximum height of editor
            // focus: true                  // set focus to editable area after initializing summernote
        });



</script>


@endsection
