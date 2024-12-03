@extends('eo.templates.index')

@section('page-content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="{{ url('eo/eventdaftar') }}" class="btn btn-sm btn-secondary shadow-sm float-right pull-right">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Daftar Event
        </a>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-coklat">
                    <h6 class="m-0 font-weight-bold text-white">Peserta Terdaftar - {{ $event->judul }}</h6>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peserta</th>
                                <th>Email</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peserta as $key => $p)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $p->nama }}</td>
                                    <td>{{ $p->email }}</td>
                                    <td>{{ tanggal($p->tanggalpemesanan) }}</td>
                                    <td>
                                        <a href="{{ url('eo/pesertadetail/' . $p->idpesertaevent) }}" class="btn btn-info">Detail</a>
                                         <a href="{{ url('eo/pesertahapus/' . $p->idpesertaevent) }}" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?')">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
