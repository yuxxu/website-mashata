@extends('layouts.main')

@section('title', 'Antrian Pasien')
@section('page-title', 'Antrian Pasien')

@section('content')
   <div class="container-fluid">
        <div class="card">
            <div class="card-header">Data Poli</div>
            <div class="card-body">
                <h2>Daftar Poli</h2>
                <a href="{{ route('poli.create') }}" class="btn btn-primary mb-3">Tambah Poli</a>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Poli</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($polis as $index => $poli)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $poli->nama_poli }}</td>
                                <td>
                                    <a href="{{ route('poli.edit', $poli->id) }}" class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
   </div>
@endsection
