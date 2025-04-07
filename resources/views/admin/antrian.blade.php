@extends('layouts.main')

@section('title', 'Antrian Pasien')
@section('page-title', 'Antrian Pasien')

@section('content')
   <div class="container-fluid">
        <div class="card">
            <div class="card-header">Data Pasien</div>
            <div class="card-body">
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

                <table class="table table-bordered mt-3">
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
                                    <form method="POST" action="{{ route('ubah.status', $data->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()">
                                            <option value="belum check-up" {{ $data->status == 'belum check-up' ? 'selected' : '' }}>Belum Check-up</option>
                                            <option value="sedang check-up" {{ $data->status == 'sedang check-up' ? 'selected' : '' }}>Sedang Check-up</option>
                                            <option value="selesai" {{ $data->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
   </div>
@endsection
