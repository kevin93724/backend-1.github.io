@extends('layout/nav')

@section('content')

<section class="engine"><a href="https://mobirise.info/g">build a website for free</a></section><section class="cid-qTkA127IK8 mbr-fullscreen mbr-parallax-background" id="header2-1">

    <div class="container">
        <div class="media-container-row">
            {{$news}}
            dd($news)

            @@foreach ($news->news_imgs as $news_img)
        <img width="50" src="{{$news_img->image}}" alt="">

            @endforeach

        </div>
    </div>

</section>

@endsection
