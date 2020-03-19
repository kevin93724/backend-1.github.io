@extends('layout/nav')

@section('css')
<style>
    .product-card .product-info .title{
        width: 100%;
        font-size: 40px;
        font-weight: 400;
        line-height: 48px;
        color: #000;
        margin: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .product-card .product-info .sub-title{
        font-size: 20px;
        line-height: 24px;
        color: #757575;
        margin-top: 8px;

    }
    .product-card .product-info .price{
        color: #ff6700;
        font-weight: 400;
    }



    .product-card .color{
    padding: 10px 20px;
    width: 160px;
    min-height: 58px;
    height: 100%;
    font-size: 16px;
    line-height: 20px;
    color: #757575;
    text-align: center;
    border: 1px solid #eee;
    /* background-color: #fff; */
    background-color:white;

    -webkit-user-select: none;
    -ms-user-select: none;
    user-select: none;
    transition: opacity,border .2s linear;
    cursor:pointer;
    }
    .product-card .color.active{
    color: #424242;
    border-color: #ff6700;
    transition: opacity,border .2s linear;
    }



</style>

@endsection


@section('content')
<section class="engine"><a href="https://mobirise.info/x">css templates</a></section><section class="features3 cid-rRF3umTBWU" id="features3-7" style="padding-top: 100px">




    <div class="container">
        <div class="media-container-row ">
            <div class="col-6">
            </div>


            <div class="col-6">
                <div class="product-card">
                    <div class="product-info">
                        <div class="title">Redmi Note 8 Pro</div>
                        <div class="sub-title">6GB+64GB, 冰翡翠</div>
                        <div class="price">NT$6599</div>
                    </div>
                    <div class="product-tips">
                        雙倍
                        該商品可享受雙倍積分
                    </div>
                    <div class="product-capacity">
                        <h3> 容量</h3>
                        <div class="row">

                            <div class="col-4">
                                <div class="color">6GB+64GB</div>
                            </div>
                            <div class="col-4">
                                <div class="color">6GB+128GB</div>
                            </div>

                        </div>

                    </div>

                    <div class="product-color">
                        <h3> 顏色</h3>
                            <div class="row">

                                <div class="col-4">
                                    <div class="color active" data-color="紅">紅</div>
                                </div>
                                <div class="col-4">
                                    <div class="color" data-color="黃">黃</div>
                                </div>
                                <div class="col-4">
                                    <div class="color" data-color="綠">綠</div>
                                </div>
                                <div class="col-4">
                                    <div class="color" data-color="紫">紫</div>
                                </div>
                            </div>
                    </div>
                    <form action="/add_cart/{{$Product->id}}" method="post">
                        @csrf
                        <div class="product-qty">
                            數量
                            <a id="minus" href="#">-</a>
                            <input type="number" value="1" id="qty">
                            <a id="plus" href="#">+</a>

                        </div>
                        <div class="product-total">
                            <div>
                                <span>Redmi Note 8 Pro</span>
                                <span>冰翡翠</span>
                                <span>6GB+64GB</span>*<span>1</span>
                                <small>NT$6,599</small>
                                NT${{$Product->price}}
                            </div>

                        </div>
                        <input type="text" name="product_id" id="product_id" value="" hidden>
                        <input type="text" name="capacity" id="capacity" hidden>
                        <input type="text" name="color" id="color" value="紅" hidden>
                        <br>
                        <button>立即購買</button>
                        {{-- 立即購買 --}}
                    </form>


                {{-- <input type="text"> --}}

                </div>

            </div>

        </div>


        </div>
    </div>
</section>
@endsection

@section('js')
<script>

    $('.product-card .color').click(function(){
        //Change 框 color

        $('.product-card .color').removeClass("active");
        $(this).addClass("active");

        //add color put in input-value


        //get data attrbute value
        var color = $(this).attr("data-color");
        // console.log(color);

        //change  input value jq
        $('#color').val(color);
    })

    $(function(){

    var valueElement = $('#qty');
    function incrementValue(e){
        // get now value
        var now_number = $('#qty').val();

        //add increment value
        var new_number = Math.max( e.data.increment + parseInt(now_number), 0);
        $('#qty').val(new_number)
        // valueElement.text(Math.max(parseInt(valueElement.text()) + e.data.increment, 0));
        return false;
    }

    $('#plus').bind('click', {increment: 1}, incrementValue);

    $('#minus').bind('click', {increment: -1}, incrementValue);

    });


</script>

@endsection

