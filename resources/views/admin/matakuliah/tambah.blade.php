@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold text-primary">Matakuliah</h1>
        </div>
        <div class="card-body">
            <!-- Form -->
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ isset($matakuliahs) ? route('matakuliah.update', $matakuliahs->id) : route('matakuliah.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="kurikulum_id" class="form-label">Kurikulum</label>
                    <select class="form-control select2 @error('kurikulum_id') is-invalid @enderror" id="kurikulum_id" name="kurikulum_id" required>
                        <option value="">Pilih Kurikulum</option>
                        @foreach ($kurikulums as $tipe)
                        <option value="{{ $tipe->id }}" {{ old('kurikulum_id', $matakuliahs->kurikulum_id ?? '') == $tipe->id ? 'selected' : '' }}>
                            {{ $tipe->nama }}
                        </option>
                        @endforeach
                    </select>
                    @error('kurikulum_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kodemk" class="form-label">Kode Mata Kuliah</label>
                    <input type="text" class="form-control @error('kodemk') is-invalid @enderror" id="kodemk" name="kodemk" value="{{ old('kodemk', $matakuliahs->kodemk ?? '') }}" required>
                    @error('kodemk')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $matakuliahs->nama ?? '') }}" required>
                    @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="sks" class="form-label">SKS</label>
                    <input type="number" class="form-control @error('sks') is-invalid @enderror" id="sks" name="sks" value="{{ old('sks', $matakuliahs->sks ?? '') }}" required>
                    @error('sks')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="semester" class="form-label">Semester</label>
                    <!-- Combo Box Semester -->
                    <select class="form-control select2" name="semester" id="semesterSelect">
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                        <option value="3">Semester 3</option>
                        <option value="4">Semester 4</option>
                        <option value="5">Semester 5</option>
                        <option value="6">Semester 6</option>
                        <option value="7">Semester 7</option>
                        <option value="8">Semester 8</option>
                        <option value="9">Semester Ganjil Pilihan</option>
                        <option value="10">Semester Genap Pilihan</option>
                    </select>
                    @error('semester')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="rps" class="form-label">RPS</label>
                    <input type="file" class="form-control @error('rps') is-invalid @enderror" id="rps" name="rps" required>
                    @error('rps')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>


                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5">{{ old('deskripsi', $matakuliahs->deskripsi ?? '') }}</textarea>
                    @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>






                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">{{ isset($matakuliahs) ? 'Update' : 'Simpan' }}</button>
                    <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Batal</a>
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
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Pilih Kurikulum",
            allowClear: true
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.semesterSelect').select2({
            placeholder: "Pilih Semester",
            allowClear: true
        });
    });
</script>
<!-- summernote Script -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#deskripsi').summernote();
    });
</script>
<!-- CKEditor Script -->
@endsection