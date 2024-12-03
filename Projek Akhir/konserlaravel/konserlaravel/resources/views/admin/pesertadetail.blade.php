@extends('admin.templates.index')

@section('page-content')
    <div class="container mt-5">
        <h1>Detail Peserta</h1>

        <!-- Display participant details -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-white">Informasi Peserta</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Nama Peserta</th>
                        <td>{{ $peserta->nama }}</td>
                    </tr>
                    <tr>
                        <th>Judul Event</th>
                        <td>{{ $peserta->judul }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pemesanan</th>
                        <td>{{ tanggal($peserta->tanggalpemesanan) }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $peserta->status }}</td>
                    </tr>
                    @if ($peserta->bukti && file_exists(public_path('foto/' . $peserta->bukti)))
                        <tr>
                            <th>Bukti Pembayaran</th>
                            <td>
                                <img src="{{ asset('foto/' . $peserta->bukti) }}" width="100px">

                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Transfer</th>
                            <td>{{ tanggal($peserta->tanggaltransfer) }}</td>
                        </tr>
                    @endif
                </table>

                <!-- Form to update the status -->
                <form method="POST" action="{{ url('eo/pesertastatusupdate/' . $peserta->idpesertaevent) }}">
                    @csrf
                    <div class="form-group">
                        <label for="status">Update Status:</label>
                        <select name="status" class="form-control" required>
                            <option value="Menunggu Konfirmasi"
                                {{ $peserta->status == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi
                            </option>
                            <option value="Pesanan Diterima" {{ $peserta->status == 'Pesanan Diterima' ? 'selected' : '' }}>
                                Pesanan Diterima</option>
                            <option value="Pesanan Ditolak" {{ $peserta->status == 'Pesanan Ditolak' ? 'selected' : '' }}>
                                Pesanan Ditolak</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </form>
            </div>
        </div>
    </div>
@endsection
