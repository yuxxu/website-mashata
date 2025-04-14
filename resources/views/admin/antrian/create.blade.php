@extends('layouts.main') <!-- Ganti kalau pakai layout lain -->

@section('content')
<div class="container mt-4">
    <h4>Tambah Antrian Baru</h4>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.antrian.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <div class="col">
                <label>Nama Pasien</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="col">
                <label>NIK</label>
                <input type="text" name="nik" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" required>
            </div>
            <div class="col">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control">
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>No. HP</label>
            <input type="text" name="no_hp" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Pilih Poli</label>
            <select name="poli_id" class="form-control" required>
                <option value="">-- Pilih Poli --</option>
                @foreach($poli as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_poli }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Antrian</button>
    </form>
</div>
@endsection
