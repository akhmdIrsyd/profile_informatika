@extends('Landing.layout')

@section('content')
<section class="news-detail-header-section text-center">
    <div class="section-overlay"></div>

    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                <h1 class="text-white">Matakuliah</h1>
            </div>

        </div>
    </div>
</section>

<section class="news-section section-padding">
    <div class="container">
        <div class="row">
            <h1>
                Daftar Matakuliah
            </h1>
            <p>
                Berikut adalah Daftar Matakuliah
            </p>
            <div class="col-lg-7 col-12">

                <!-- Panel 1 -->
                @if($dataPerSemester->isEmpty())
                <p>Tidak ada data matakuliah.</p>
                @else
                @foreach($dataPerSemester as $semester => $matakuliah)
                <p>
                    <a class="btn btn-primary w-100" data-bs-toggle="collapse" href="#panel{{ $semester }}" role="button" aria-expanded="false" aria-controls="panel1">
                        @if($semester ==9)
                        Pilihan Ganjil
                        @elseif($semester ==10)
                        Pilihan Genap
                        @else
                        Semester {{ $semester }}
                        @endif
                    </a>
                </p>
                <div class="container-fluid mb-3">
                    <div class="collapse" id="panel{{ $semester }}">
                        <div class="card card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Matakuliah</th>
                                            <th>SKS</th>
                                            <th>RPS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($matakuliah as $m)
                                        <tr>
                                            <td>{{ $m->nama }}</td>
                                            <td>{{ $m->sks }}</td>
                                            <td><a href="{{ asset('file_rps/' . $m->rps) }}" target="_blank">View RPS</a></td>
                                        </tr>
                                        @endforeach

                                        <!-- Add more rows as needed -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
                <!-- Panel 2 (if needed, you can add similar or different content) -->






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