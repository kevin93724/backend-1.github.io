@extends('layout/nav')

@section('content')
<section class="engine"><a href="https://mobirise.info/x">css templates</a></section><section class="features3 cid-rRF3umTBWU" id="features3-7">




    <div class="container">
        <div class="media-container-row">

            @foreach($news_data as $item)

            <div class="card p-3 col-12 col-md-6 col-lg-4">
                <div class="card-wrapper">
                    <div class="card-img">
                        <img src="{{$item->image}}" alt="Mobirise">
                    </div>
                    <div class="card-box">
                        <h4 class="card-title mbr-fonts-style display-7">
                        {{$item->title}}
                        </h4>
                        <p class="mbr-text mbr-fonts-style display-7">
                        {{$item->content}}
                        </p>
                    </div>
                    <div class="mbr-section-btn text-center">
                        <a href="https://mobirise.co" class="btn btn-primary display-4">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>

            @endforeach


            <!-- <div class="card p-3 col-12 col-md-6 col-lg-4">
                <div class="card-wrapper">
                    <div class="card-img">
                        <img src="{{asset('assets/images/background2.jpg')}}" alt="Mobirise">
                    </div>
                    <div class="card-box">
                        <h4 class="card-title mbr-fonts-style display-7">
                            Mobile Friendly
                        </h4>
                        <p class="mbr-text mbr-fonts-style display-7">
                            All sites you make with Mobirise are mobile-friendly. You don't have to create a special mobile version of your site.
                        </p>
                    </div>
                    <div class="mbr-section-btn text-center">
                        <a href="https://mobirise.co" class="btn btn-primary display-4">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>

            <div class="card p-3 col-12 col-md-6 col-lg-4">
                <div class="card-wrapper">
                    <div class="card-img">
                        <img src="{{asset('assets/images/background3.jpg')}}" alt="Mobirise">
                    </div>
                    <div class="card-box">
                        <h4 class="card-title mbr-fonts-style display-7">
                            Unique Styles
                        </h4>
                        <p class="mbr-text mbr-fonts-style display-7">
                            Mobirise offers many site blocks in several themes, and though these blocks are pre-made, they are flexible.
                        </p>
                    </div>
                    <div class="mbr-section-btn text-center">
                        <a href="https://mobirise.co" class="btn btn-primary display-4">
                            Learn More
                        </a>
                    </div>
                </div>
            </div> -->


        </div>
    </div>
</section>
@endsection


