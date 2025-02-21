@extends('Landing.layout')

@section('content')
<section class="news-detail-header-section text-center">
    <div class="section-overlay"></div>

    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                <h1 class="text-white">Tendik</h1>
            </div>

        </div>
    </div>
</section>

<section class="news-section section-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-7 col-12">
                @foreach ($datas as $item)
                <div class="row custom-block-wrap">
                    <h2 class="mb-3"></h2>
                    <div class="col-lg-6 col-md-5 col-12">
                        <img src="{{ asset('foto_profil/' . $item->foto) }}" style="width: 520px; height: 320px;"
                            class=" ms-lg-auto bg-light shadow-lg img-fluid" alt="">
                    </div>

                    <div class="col-lg-5 col-md-7 col-12">
                        <div class="custom-text-block">
                            <h6 class="mb-0">{{ $item->nama }}</h6>

                            <a href="{{route('landingpage.detailtendik', $item->id)}}" class="custom-btn btn">Detail</a>
                        </div>
                    </div>
                </div>
                <hr style="border: 2px solid black;">
                @endforeach
                {{ $datas->links('pagination::bootstrap-4') }}
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