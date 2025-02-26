@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold text-primary">Detail Alumni</h1>
        </div>
        <div class="card-body">
            <!-- Form -->
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('detailalumni.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Row 1 -->
                <h4>Informasi Alumni</h4>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $profile->nama) }}" placeholder="Masukkan Nama">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nip">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim" value="{{ old('nim', $profile->nim) }}" placeholder="Masukkan NIM">
                        </div>
                    </div>

                </div>

                <!-- Row 2 -->
                <h4>Tahun Masuk & Lulus</h4>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="angkatan">Tahun Masuk</label>
                            <input type="text" class="form-control" id="angkatan" name="angkatan" value="{{ old('angkatan', $profile->angkatan) }}" placeholder="Masukkan Tahun Masuk">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lulus">Tahun Lulus</label>
                            <input type="text" class="form-control" id="lulus" name="lulus" value="{{ old('lulus', $profile->lulus) }}" placeholder="Masukkan Tahun Lulus">
                        </div>
                    </div>
                </div>

                <!-- Row 2 -->
                <h4>Kontak</h4>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $profile->email) }}" placeholder="Masukkan Email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telpon">Telepon</label>
                            <input type="text" class="form-control" id="telpon" name="telpon" value="{{ old('telpon', $profile->telpon) }}" placeholder="Masukkan Telepon">
                        </div>
                    </div>
                </div>

                <!-- Row 2 -->
                <h4>IPK & Skripsi </h4>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ipk">IPK</label>
                            <input type="ipk" class="form-control" id="ipk" name="ipk" value="{{ old('ipk', $profile->ipk) }}" placeholder="Masukkan IPK">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="skripsi">Judul Skripsi</label>
                            <input type="text" class="form-control" id="skripsi" name="skripsi" value="{{ old('skripsi', $profile->skripsi) }}" placeholder="Masukkan Judul Skripsi">
                        </div>
                    </div>
                </div>



                <!-- Row 4 -->
                <h4>Foto & Testimoni</h4>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*" placeholder="Upload foto">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="testimoni">Testimoni</label>
                            <input type="text" class="form-control" id="testimoni" name="testimoni" value="{{ old('testimoni', $profile->testimoni) }}" placeholder="Masukkan Testimoni" required>
                        </div>
                    </div>
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('detailalumni.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>

            <!-- form -->
        </div>
    </div>
</div>



@endsection
@section('extrajs')
<!-- Page level plugins -->
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>


@endsection