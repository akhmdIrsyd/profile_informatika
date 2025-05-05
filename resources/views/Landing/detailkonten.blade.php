@extends('Landing.layout')

@section('content')
<section class="news-detail-header-section text-center">
    <div class="section-overlay"></div>

    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                <h1 class="text-white">{{ $konten->judul }}</h1>
            </div>

        </div>
    </div>
</section>

<section class="news-section section-padding">
    <div class="container ">
        <div class="row">

            <div class="col-lg-7 col-12">
                <div class="news-block">


                    <div class="news-block-info">


                        <div class="news-block-title mb-2 ">
                            <h1><a href="#" class="news-block-title-link "> {{ $konten->judul }}</a></h1>
                        </div>

                        <div class="news-block-body">
                            {!! $konten->isi !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-12 mx-auto mt-4 mt-lg-0 ">


                <div class="category-block d-flex flex-column">

                    @include('Landing.sidebar')

                </div>




            </div>

        </div>
    </div>
</section>
@endsection
@section('extrajs')

@endsection