@extends('Landing.layout')

@section('content')
<section class="news-detail-header-section text-center">
    <div class="section-overlay"></div>

    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                @if (Request::is('*berita'))
                <h1 class="text-white">Berita</h1>
                @endif
                @if (Request::is('*pengumuman*'))
                <h1 class="text-white">Pengumuman</h1>
                @endif
                @if (Request::is('*beasiswa*'))
                <h1 class="text-white">Beasiswa</h1>
                @endif
                @if (Request::is('*prestasi*'))
                <h1 class="text-white">Prestasi</h1>
                @endif
            </div>

        </div>
    </div>
</section>

<section class="news-section section-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-7 col-12">
                @foreach ($informasi as $item)
                <div class="news-block ">
                    <div class="news-block-top custom-block-wrap">
                        <a href="{{route('landingpage.detailinformasi', $item->id)}}">
                            <img src="{{ asset('gambar_informasi/' . $item->gambar) }}" style="width: 100%; height: 320px;" class="news-image img-fluid" alt="">
                        </a>

                        <div class="news-category-block">
                            <a href="#" class="category-block-link">

                            </a>

                            <a href="#" class="category-block-link">

                            </a>
                        </div>
                    </div>

                    <div class="news-block-info">
                        <div class="d-flex mt-2">
                            <div class="news-block-date">
                                <p>
                                    <i class="bi-calendar4 custom-icon me-1"></i>
                                    {{ $item->created_at }}
                                </p>
                            </div>



                        </div>

                        <div class="news-block-title mb-2">
                            <h4><a href="{{route('landingpage.detailinformasi', $item->id)}}" class="news-block-title-link"> {{ $item->judul }}</a></h4>
                        </div>

                        <div class="news-block-body">
                        </div>
                    </div>
                </div>
                <hr style="border: 2px solid black;">
                @endforeach
                {{ $informasi->links('pagination::bootstrap-4') }}
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