@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection


@section('content')

<div class="container">
<a href="/home/products/create" class="btn btn-success">新增產品資料</a>
<hr>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>types</th>
                <th>image</th>
                <th>title</th>
                <th>sort</th>
                <th>content</th>
                <th width="100"></th>

            </tr>
        </thead>
        <tbody>
          @foreach ($all_products as $item)
            <tr> 
                <td>{{$item->product_type->types}}</td>
                <td><img width="120" src="{{$item->image}}" alt=""></td>
                <td>{{$item->title}}</td>
                <td>{{$item->sort}}</td>
                <td>{!!$item->content!!}</td>

                <td> <a href="/home/news/edit/{{$item->id}}" class="btn btn-success btn-sm">修改</a>
                      <button class="btn btn-danger btn-sm" onclick="show_confirm({{$item->id}})">刪除</button>
                      <form id="delete-form-{{$item->id}}" action="/home/news/delete/{{$item->id}}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </td>
            </tr>
          @endforeach


        </tbody>

    </table>




</div>

@endsection

@section('js')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js
">

</script>
<script src="
https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js">

</script>
<script >
  $(document).ready(function() {
    $('#example').DataTable();
} );

function show_confirm(id)
{
    console.log(id);

    var r=confirm("你確定要刪除嗎!");
    if (r==true)
    {
        //使用者確定刪除
        document.getElementById(`delete-form-${id}`).submit();
    }
}



</script>

@endsection
