@extends('layouts/app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
<style>
    .products_img_card .btn-danger {
        position: absolute;
        top: 0px;
        right: 15px;
        border-radius: 50%;
    }
</style>
@endsection


@section('content')

<div class="container">
<h1>產品管理-修改</h1>


<form method="POST" action="/home/products/update/{{$products->id}}" enctype="multipart/form-data">
    @csrf
  <div class="form-group">
    <label for="img">現有圖片</label>
    <img class="mg-fluid" width="250" src="{{$products->image}}" alt="">
  </div>
  {{-- multi-fig --}}
  <div class="form-group">
    <label for="title">重新上傳圖片(建議圖片尺寸寬400px x 高200px)</label>
    <input type="file" class="form-control" id="img" name="img">
</div>
<hr>
<div class="row">
    現有多張圖片組
    @foreach ($products->products_imgs as $item)
    <div class="col-2">
        <div class="products_img_card" data-productsimgid="{{$item->id}}">
            <button type="button" class="btn btn-danger" data-productsimgid="{{$item->id}}">X</button>
            <img class="img-fluid" src="{{$item->image_url}}" alt="">
            <input class="form-control" type="text" value="{{$item->sort}}" onchange="ajax_post_sort(this,{{$item->id}})">
        </div>
    </div>
    @endforeach
</div>
<div class="form-group">
    <label for="img">新增多張圖片組(建議圖片尺寸寬400px x 高200px)</label>
    <input type="file" class="form-control" id="products_imgs" name="products_imgs[]" multiple>
</div>
<hr>
  {{-- multi-fig --}}



  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="{{$products->title}}">
  </div>
  <div class="form-group">
    <label for="sort">權重(數字越大的排在越前面)</label>
    <input type="number" min="0" class="form-control" id="sort" name="sort" value="{{$products->sort}}">
  </div>

  <div class="form-group">
    <label for="content">Content</label>
    <textarea type="text" class="form-control summernote" name="content" id="content" cols="30" rows="10">{!!$products->content!!}</textarea>
    {{-- <input type="text" class="form-control" id="content" name="content" value="{{$products->content}}"> --}}
  </div>

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

        $('.products_img_card .btn-danger').click(function(){

            var newimgid = this.getAttribute('data-productsimgid')


            $.ajax({
                url: "/home/ajax_delete_products_imgs",    //來自web.php設定
                method: 'post',
                data: {
                    productsimgid: newimgid,
                },
                success: function(result){
                    $(`.products_img_card[data-productsimgid=${newimgid}]`).remove();
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
