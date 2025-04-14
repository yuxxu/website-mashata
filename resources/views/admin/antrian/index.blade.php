@extends('layouts.main')

@section('title', 'Antrian Pasien')
@section('page-title', 'Antrian Pasien')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Antrian</h1>
        <a href="{{ route('admin.antrian.download') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Download CSV </a>
    </div>
    <div class="card">


        <div class="card-body">

            @auth
            @if (Auth::user()->role === 'admin')
            <div class="action" style="display:flex;">
                <form method="POST" action="{{ route('admin.reset-antrian') }}" onsubmit="return confirm('Yakin mau reset semua antrian?')">
                    @csrf
                    <button type="submit" class="btn btn-primary mb-3">
                        Reset Antrian
                    </button>
                </form>
                <a href="{{ route('admin.antrian.create') }}" class="btn btn-primary mb-3" style="margin-left:15px;">Tambah Antrian</a>
            </div>
            @endif
            @endauth

            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="GET" action="{{ route('admin.antrian') }}">
                <select name="poli_id" onchange="this.form.submit()">
                    <option value="">Pilih Poli</option>
                    @foreach ($polis as $poli)
                    <option value="{{ $poli->id }}" {{ $selectedPoli == $poli->id ? 'selected' : '' }}>
                        {{ $poli->nama_poli }}
                    </option>
                    @endforeach
                </select>
            </form>

            <table class="table" style="margin-top:10px;">
                <thead>
                    <tr>
                        <th>No. Antrian</th>
                        <th>Nama Pasien</th>
                        <th>Poli</th> <!-- Kolom tambahan -->
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($antrian as $data)
                    <tr>
                        <td>{{ $data->nomor_antrian }}</td>
                        <td>{{ $data->pasien->nama }}</td>
                        <td>{{ $data->poli->nama_poli }}</td> <!-- Menampilkan nama poli -->
                        <td>{{ $data->status }}</td>
                        <td>
                            <!-- Dropdown untuk ubah status -->
                            <form method="POST" action="{{ route('ubah.status', $data->id) }}" style="margin-bottom: 5px;">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()" class="form-control form-control-sm">
                                    <option value="belum check-up" {{ $data->status == 'belum check-up' ? 'selected' : '' }}>Belum Check-up</option>
                                    <option value="sedang check-up" {{ $data->status == 'sedang check-up' ? 'selected' : '' }}>Sedang Check-up</option>
                                    <option value="selesai" {{ $data->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </form>

                            <!-- Tombol Edit -->
                            <a href="{{ route('admin.antrian.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
