@extends('layouts.antrian')

@section('content')

    <div class="container" id="page-one">
        <h3 class="title">Lihat Antrian</h3>
        <div class="inner-content">
            <section class="section-left">

                <form method="GET" action="{{ route('antrian') }}" class="select">
                    <select name="poli_id" onchange="this.form.submit()">
                        <option value="">Pilih Poli</option>
                        @foreach ($polis as $poli)
                            <option value="{{ $poli->id }}" {{ $selectedPoli == $poli->id ? 'selected' : '' }}>
                                {{ $poli->nama_poli }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <div class="stats">
                    <div class="stat-card">
                        <h2>{{ $totalAntrian }}</h2>
                        <p>Total Pasien</p>
                    </div>
                    <div class="stat-card">
                        <h2>{{ $nomorAntrianPasien }}</h2>
                        <p>No. Antrian Anda</p>
                    </div>

                    <div class="stat-card">
                        <h2>{{ $sudahCheckUp }}</h2>
                        <p>Sudah Check-up</p>
                    </div>

                    <div class="stat-card">
                        <h2>{{ $belumCheckUp }}</h2>
                        <p>Belum Check-up</p>
                    </div>
                </div>
                
                    <div class="data" id="dataTable" style="{{ count($antrian) > 0 ? '' : 'display: none;' }}">
                        <table>
                            <tr>
                                <th>No. Antrian</th>
                                <th>Pasien Nama</th>
                                <th>Status</th>
                            </tr>
                            @foreach ($antrian as $data)
                                <tr>
                                    <td>{{ $data['nomor_antrian'] }}</td>
                                    <td>{{ $data->pasien->nama }}</td> <!-- Tampilkan nama pasien -->
                                    {{-- <td>{{ $data['pasien_id'] }}</td> --}}
                                    {{-- <td>{{ $data['poli_id'] }}</td> --}}
                                    <td>{{ $data['status'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
            </section>
        </div>
    </div>
@endsection