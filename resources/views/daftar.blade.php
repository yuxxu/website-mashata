@extends('layouts.daftar')

@section('content')
    <div class="container" id="page-one" >
        <div class="inner-content">
            <section class="left-section">
                <div class="text-area">
                    <h3>Daftar Konsultasi {{ $poli->nama_poli }}</h3>
                </div>
                <form action="{{ route('daftar.pasien', [], true) }}" method="POST">
                    @csrf
                    <div class="input-area">
                    <input type="hidden" name="poli_id" value="{{ $poli->id }}">
                    <input type="text" name="nama" class="input" placeholder="Nama" required>
                    
                    <input type="text" name="nik" class="input" placeholder="NIK" class="input" required>
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="input" required>

                    <!-- Input Jenis Kelamin -->
                    <select name="jenis_kelamin" class="input" required>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>

                    <textarea name="alamat" class="input" placeholder="Alamat" required></textarea>

                    <input type="text" name="no_hp" class="input" placeholder="No. HP" required>
                    </div>
                    <button>Submit <i class="fa-solid fa-circle-check"></i></button>
                </form>
            </section>
            <section class="right-section">
                <div class="text-area">
                    <b>Pastikan Data Anda Benar! 🔔</b>
                    <p>✅ Periksa kembali nama lengkap, NIK, dan nomor telepon.</p>
                    <p>✅ Pastikan jadwal dan poli yang dipilih sesuai kebutuhan.</p>
                    <p>✅ Data yang salah dapat menyebabkan kendala saat pendaftaran.</p>
                    <p>📌 Jika ada kesalahan, segera perbaiki sebelum konfirmasi! 😊</p>
                </div>
            </section>
        </div>
    </div>
@endsection