@extends('home.templates.index')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@section('page-content')
    <section id="home-section" class="ftco-section">
        <div class="container mt-4">
            <h1 style="color: black; font-weight:bold;">Riwayat Pembelian Tiket</h1>
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th style="color: black;" width="10px">No</th>
                                        <th style="color: black;" width="30%">Event</th>
                                        <th style="color: black;">Tanggal Pembelian</th>
                                        <th style="color: black;">Total</th>
                                        <th style="color: black;">Status</th>
                                        <th style="color: black;">Bukti Pembayaran</th>
                                        <th style="color: black;">Opsi</th>
                                        <th style="color: black;">Batalkan Pesanan</th> <!-- Kolom baru -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $nomor = 1; ?>
                                    @foreach ($databeli as $db)
                                        <tr>
                                            <td style="color: black;"><?php echo $nomor; ?></td>
                                            <td style="color: black;">
                                                {{ $db->judul }}<br>
                                            </td>
                                            <td style="color: black;">
                                                {!! tanggal($db->tanggalpemesanan) !!}
                                            </td>
                                            <td style="color: black;">Rp {{ number_format($db->harga) }}</td>
                                            <td style="color: black;">{{ $db->status }}</td>
                                            <td class="text-center">
                                                @if (!empty($db->bukti) && file_exists(public_path('foto/' . $db->bukti)))
                                                    <img width="100px" src="{{ asset('foto/' . $db->bukti) }}" alt="">
                                                @else
                                                    <strong><span class="text-center">-</span></strong>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($db->status == 'Menunggu Pembayaran')
                                                    <a href="{{ url('home/detailtransaksi/' . $db->idpesertaevent) }}"
                                                        class="btn text-white" style="background-color: #A38758">Upload Bukti Pembayaran</a>
                                                @elseif ($db->status == 'Menunggu Konfirmasi')
                                                    <span class="btn btn-warning">Menunggu Konfirmasi</span>
                                                @elseif ($db->status == 'Pesanan Diterima')
                                                    <span class="btn btn-success">Pesanan Diterima</span>
                                                @elseif ($db->status == 'Selesai')
                                                    <span class="btn btn-success">Selesai</span>
                                                @elseif ($db->status == 'Pesanan Ditolak')
                                                    <span class="btn btn-danger">Pesanan Ditolak</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (session('pengguna'))
                                                    <form method="POST" action="{{ url('home/batalkan') }}" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');">
                                                        @csrf
                                                        <input type="hidden" name="idpesertaevent" value="{{ $db->idpesertaevent }}">
                                                        <input type="hidden" name="idevent" value="{{ $db->idevent }}">
                                                        <button type="submit" class="btn btn-danger">Batalkan</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                        <?php $nomor++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            {{ $databeli->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection