@extends('home.templates.index')

@section('page-content')
    <section id="home-section" class="ftco-section">
        <div class="container mt-4">
            <!-- Status Pembelian -->
            @if ($datapembelian->status == 'Menunggu Pembayaran')
                <div class="mt-5">
                    <h1 style="color: black; font-weight:bold;">Pembayaran</h1>
                    <p style="color: black;">Silakan upload bukti pembayaran Anda. Pembayaran harus dilakukan sebelum
                        <strong>{{ date('d M Y H:i', strtotime($datapembelian->tanggalpemesanan . ' +1 day')) }}</strong>
                    </p>

                    <form method="POST" action="{{ url('home/pembayaransimpan') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="idpesertaevent" value="{{ $datapembelian->idpesertaevent }}">

                        <!-- Input Tanggal Transfer -->
                        <div class="form-group">
                            <label for="tanggaltransfer">Tanggal Transfer</label>
                            <input type="date" name="tanggaltransfer" class="form-control" required>
                        </div>

                        <!-- Input Bukti Pembayaran -->
                        <div class="form-group">
                            <label for="bukti">Upload Bukti Pembayaran</label>
                            <input type="file" name="bukti" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Upload Bukti Pembayaran</button>
                    </form>
                </div>
            @else
                <!-- Tampilkan status jika sudah melakukan pembayaran -->
                <div>
                    <h1 style="color: black; font-weight:bold;">Status Pembelian</h1>
                    <p style="color: black;">Status pembelian Anda: <strong>{{ $datapembelian->status }}</strong></p>
                    @if ($datapembelian->status == 'Menunggu Konfirmasi')
                        <p style="color: black;">Menunggu konfirmasi dari admin.</p>
                    @elseif ($datapembelian->status == 'Pesanan Diterima')
                        <p style="color: black;">Pesanan Anda telah diterima.</p>
                    @elseif ($datapembelian->status == 'Selesai')
                        <p style="color: black;">Pesanan Anda telah selesai.</p>
                    @elseif ($datapembelian->status == 'Pesanan Ditolak')
                        <p style="color: black;">Pesanan Anda ditolak.</p>
                    @endif
                </div>
            @endif

            <hr>
            <h2 style="color: black;">Detail Pembelian</h2>
            <ul>
                @foreach ($dataevent as $event)
                    <li style="color: black;">
                        <strong>{{ $event->judul }}</strong> <br>
                        {{ tanggal($event->tanggalevent) }} | {{ date('H:i', strtotime($event->jamevent)) }} <br>
                        Lokasi: {{ $event->lokasi }}
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection
