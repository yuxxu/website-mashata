@extends('layouts.app')

@section('content')
    <!-- Page One -->
    <div class="container" id="page-one">
        <video autoplay loop muted playsinline class="bg-video">
            <source src="{{ asset('asset/images/bg/bg-vid-2.mp4') }}" type="video/mp4">
        </video>

        <div class="inner-content">
            <div class="underlay-container">
                <section class="left-section">
                    <div class="text-area">
                        <h3>Halo {{ Auth::user()->name }} !</h3>
                        <p>Ada yang bisa kami bantu?</p>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Page Two: Daftar Poli -->
    <div class="container" id="page-two">
        <div class="inner-content">
            <h3 class="title">Daftar Poli</h3>
            <div class="slider-container swiper">
                <div class="card-list swiper-wrapper">
                @foreach ($polis->chunk(3) as $poliChunk) <!-- Bagi poli menjadi grup isi 3 -->
                    <div class="card-item swiper-slide"> <!-- Slide baru setiap 3 item -->
                            <div class="cards">
                            @foreach ($poliChunk as $poli)
                                <div class="card">
                                    <div class="card-image">
                                        <img src="{{ asset('storage/' . $poli->image) }}" alt="{{ $poli->nama_poli }}">
                                    </div>
                                    <div class="card-content">
                                        <h3>{{ $poli->nama_poli }}</h3>
                                        <p>{{ $poli->deskripsi }}</p>
                                        <a href="{{ route('daftar', ['poli' => $poli->id]) }}">Daftar <i class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                    </div>
                @endforeach
            </div>

                <!-- Swiper Navigation -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>

    <!-- Page Three -->
    <div class="container" id="page-three">
        <div class="inner-content">
            <div class="text-area" id="item-type-one">
                <div class="type-one">
                    <h3>Booking Online</h3>
                    <i class="fa-solid fa-book-bookmark"></i>
                </div>
                <div class="type-two">
                    <p>Pesan layanan kesehatan dengan mudah tanpa harus antre di tempat.</p>
                </div>
            </div>

            <div class="text-area" id="item-type-two">
                <div class="type-two">
                    <p>Isi data diri anda untuk kemudahan akses layanan.</p>
                </div>
                <div class="type-one">
                    <h3>Daftarkan Diri</h3>
                    <i class="fa-solid fa-right-to-bracket"></i>
                </div>
            </div>

            <div class="text-area" id="item-type-one">
                <div class="type-one">
                    <h3>Lihat Antrian</h3>
                    <i class="fa-solid fa-folder-tree"></i>
                </div>
                <div class="type-two">
                    <p>Cek status antrean secara real-time agar lebih efisien.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Four: Panduan -->
     <div class="container" id="page-four">
        <div class="inner-content">
            <section class="left-section">
                <div class="text-area">
                    <h3>Panduan</h3>
                    <i class="fa-solid fa-book"></i>
                </div>
            </section>

            <section class="right-section">
                <div class="text-area">
                    <h3>Akses Website</h3>
                    <p>Buka website resmi Puskesmas di [www.puskesmasbooking.com]</p>
                </div>
                <div class="text-area">
                    <h3>Pilih Layanan</h3>
                    <p>Pilih jenis poli yang dibutuhkan (Poli Umum, Poli Gigi, Poli KIA, dll.).</p>
                </div>
                <div class="text-area">
                    <h3>Isi Data Pasien</h3>
                    <p>Masukkan nama lengkap, NIK, nomor telepon, dan informasi lainnya. (Pastikan data yang diinput
                        sudah benar.)</p>
                </div>
                <div class="text-area">
                    <h3>Konfirmasi Booking</h3>
                    <p>Periksa kembali detail pemesanan.</p>
                </div>
                <div class="text-area">
                    <h3>Datang ke Puskesmas</h3>
                    <p>Tunjukkan kode booking atau bukti pendaftaran di loket pendaftaran saat datang ke Puskesmas.</p>
                </div>
            </section>
        </div>
    </div>
@endsection
