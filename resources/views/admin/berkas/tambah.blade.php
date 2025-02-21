@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold text-primary">Berkas</h1>
        </div>
        <div class="card-body">
            <!-- Form -->
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ isset($berkas) ? route('berkas.update', $berkas->id) : route('berkas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="tipeberkas_id" class="form-label">Tipe Berkas</label>
                    <select class="form-control select2 @error('tipeberkas_id') is-invalid @enderror" id="tipeberkas_id" name="tipeberkas_id" required>
                        <option value="">Pilih Tipe Berkas</option>
                        @foreach ($tipeberkases as $tipe)
                        <option value="{{ $tipe->id }}" {{ old('tipeberkas_id', $berkas->tipeberkas_id ?? '') == $tipe->id ? 'selected' : '' }}>
                            {{ $tipe->nama }}
                        </option>
                        @endforeach
                    </select>
                    @error('tipeberkas_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $berkas->tanggal ?? '') }}" required>
                    @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $berkas->judul ?? '') }}" required>
                    @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="file_berkas" class="form-label">File</label>
                    <input type="file" class="form-control @error('file_berkas') is-invalid @enderror" id="file_berkas" name="file_berkas" required>
                    @error('')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">{{ isset($berkas) ? 'Update' : 'Simpan' }}</button>
                    <a href="{{ route('berkas.index') }}" class="btn btn-secondary">Batal</a>
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
<!-- tinymce Script -->

<!-- Page level custom scripts -->
<script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Pilih Tipe Berkas",
            allowClear: true
        });
    });
</script>


@endsection