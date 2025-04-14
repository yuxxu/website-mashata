@extends('layouts.main') <!-- Ganti sesuai layout kamu -->

@section('content')
<div class="container mt-4">
    <h4>Edit Data Antrian</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.antrian.update', $antrian->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col">
                <label>Nama Pasien</label>
                <input type="text" name="nama" value="{{ $antrian->pasien->nama }}" class="form-control" required>
            </div>
            <div class="col">
                <label>NIK</label>
                <input type="text" name="nik" value="{{ $antrian->pasien->nik }}" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ $antrian->pasien->tanggal_lahir }}" class="form-control" required>
            </div>
            <div class="col">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control">
                    <option value="L" {{ $antrian->pasien->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ $antrian->pasien->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" value="{{ $antrian->pasien->alamat }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>No. HP</label>
            <input type="text" name="no_hp" value="{{ $antrian->pasien->no_hp }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Pilih Poli</label>
            <select name="poli_id" class="form-control" required>
                @foreach($poli as $item)
                    <option value="{{ $item->id }}" {{ $antrian->poli_id == $item->id ? 'selected' : '' }}>{{ $item->nama_poli }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Status Antrian</label>
            <select name="status" class="form-control">
                <option value="belum check-up" {{ $antrian->status == 'belum check-up' ? 'selected' : '' }}>Belum Check-up</option>
                <option value="sedang check-up" {{ $antrian->status == 'sedang check-up' ? 'selected' : '' }}>Sedang Check-up</option>
                <option value="selesai" {{ $antrian->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Antrian</button>
    </form>
</div>
@endsection
