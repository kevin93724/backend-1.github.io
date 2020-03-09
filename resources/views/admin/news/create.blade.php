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
<script src="{{asset('js/summernote-zh-TW.js')}}"></script>


<script>
    $(document).ready(function() {
        $('#content').summernote({
            height: 300,
            lang: 'zh-TW',
            callbacks: {
                onImageUpload: function(files) {
                    for(let i=0; i < files.length; i++) {
                        $.upload(files[i]);
                    }
                },
                onMediaDelete : function(target) {
                    $.delete(target[0].getAttribute("src"));
                }
            },
        });


        $.upload = function (file) {
            let out = new FormData();  //建立一個表單格式
            out.append('file', file, file.name);  //將單筆檔案放入表單格式中(欄位name,檔案類型,檔案名稱)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                url: '/admin/ajax_upload_img',
                contentType: false,
                cache: false,
                processData: false,
                data: out,
                success: function (img) {
                    $('#content').summernote('insertImage', img);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        };

        $.delete = function (file_link) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                url: '/admin/ajax_delete_img',
                data: {file_link:file_link},
                success: function (img) {
                    console.log("delete:",img);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        }
   });
</script>


@endsection

