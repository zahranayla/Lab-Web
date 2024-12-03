@extends('home.templates.index')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@section('page-content')
    <style>
        .price-wrapper {
            background-color: #333333;
            padding: 10px;
            width: 100%;
            text-align: center;
            border-radius: 5px;
            display: inline-block;
            color: #fff;
            margin-top: 10px;
        }

        .price {
            margin: 0;
        }

        .quantity-input {
            width: 100px;
            margin-right: 10px;
            display: inline-block;
        }

        .description {
            margin-top: 20px;
        }

        .image-popup img {
            border-radius: 10px;
            max-height: 500px;
            object-fit: cover;
        }

        .btn-beli {
            background-color: #55acce !important;
            color: white;
        }

        .btn-beli:hover {
            background-color: #44a5b6 !important;
        }

        .btn-favorit-tambah {
            background-color: #ffc107 !important;
            color: #333 !important;
            border: none !important
        }

        .btn-favorit-tambah:hover {
            background-color: #e0a800 !important;
            color: #fff !important
        }

        .btn-favorit-hapus {
            background-color: #dc3545 !important;
            color: #000000 !important;
            border: none !important
        }

        .btn-favorit-hapus:hover {
            background-color: #c82333 !important;
            color: #000000 !important
        }
    </style>

    <section class="ftco-section">
        <div class="container">
            <div class="row mt-5">
                <!-- Image Section -->
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="{{ asset('foto/' . $event->foto) }}" class="image-popup  img-fluit=d">
                        <img src="{{ asset('foto/' . $event->foto) }}" alt="{{ $event->judul }}" width="100%">
                    </a>
                </div>

                <!-- Event Details -->
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3 style="color: black;">{{ $event->judul }}</h3>
                    <p style="color: black;">
                        <strong>Tanggal:</strong> {{ tanggal($event->tanggalevent) }}<br>
                        <strong>Jam:</strong> {{ $event->jamevent }}<br>
                        <strong>Lokasi:</strong> {{ $event->lokasi }}<br>
                        <strong>Kuota:</strong> {{ $event->kuota }}
                    </p>
                    <hr>
                    <div class="price-wrapper">
                        <p class="price"><span style="color: white">Rp {{ number_format($event->harga) }}</span></p>
                    </div>

                    <form method="post" action="{{ url('home/pesan') }}"
                        onsubmit="return confirm('Apakah Anda yakin ingin memesan tiket ini?')">
                        @csrf
                        <input type="hidden" name="idevent" value="{{ $event->idevent }}">
                        <hr>
                        <button class="btn btn-beli float-right" name="beli">Pesan Tiket</button>
                    </form>

                    @if (session('pengguna'))
                        @php
                            $iduser = session('pengguna')->id;
                            $isFavorit = DB::table('favorit')
                                ->where('iduser', $iduser)
                                ->where('idevent', $event->idevent)
                                ->exists();
                        @endphp
                        @if ($isFavorit)
                            <!-- Tombol Hapus dari Favorit -->
                            <form method="post" action="{{ url('home/hapusFavorit') }}" class="mt-3">
                                @csrf
                                <input type="hidden" name="idevent" value="{{ $event->idevent }}">
                                <button class="btn btn-favorit-hapus" name="hapusFavorit">Hapus dari Favorit</button>
                            </form>
                        @else
                            <!-- Tombol Tambahkan ke Favorit -->
                            <form method="post" action="{{ url('home/favorit') }}" class="mt-3">
                                @csrf
                                <input type="hidden" name="idevent" value="{{ $event->idevent }}">
                                <button class="btn btn-favorit-tambah" name="favorit">Tambahkan ke Favorit</button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>

            <!-- Event Description -->
            <div class="description card py-3 px-3 mt-4">
                <h4 class="text-black">Deskripsi:</h4>
                <p>{!! $event->deskripsi !!}</p>
            </div>
        </div>
    </section>
@endsection
