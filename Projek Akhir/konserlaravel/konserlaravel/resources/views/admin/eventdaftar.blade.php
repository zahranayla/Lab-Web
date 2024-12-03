@extends('admin.templates.index')

@section('page-content')
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="{{ url('admin/eventtambah') }}" class="btn btn-sm btn-secondary shadow-sm float-right pull-right">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Event
        </a>
    </div> --}}
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-coklat">
                    <h6 class="m-0 font-weight-bold text-white">Data Event</h6>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Oganizer</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Foto</th>
                                <th>Detail</th>
                                <th>Kuota</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $key => $event)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $event->nama }}</td>
                                    <td>{{ $event->judul }}</td>
                                    <td>{!! $event->deskripsi !!}</td>
                                    <td>{{ rupiah($event->harga) }}</td>
                                    <td>
                                        <img src="{{ asset('foto/' . $event->foto) }}" width="100px">
                                    </td>
                                    <td>
                                        <strong>Tanggal:</strong> {{ tanggal($event->tanggalevent) }} <br>
                                        <strong>Jam:</strong> {{ date('H:i', strtotime($event->jamevent)) }} <br>
                                        <strong>Lokasi:</strong> {{ $event->lokasi }}
                                    </td>
                                    <td>{{ $event->kuota }}</td>
                                    <td>
                                        <a href="{{ url('admin/pesertadaftar/' . $event->idevent) }}"
                                            class="btn btn-info m-1">Daftar Peserta</a>
                                        {{-- <a href="{{ url('admin/eventedit/' . $event->idevent) }}"
                                            class="btn btn-primary">Ubah</a>
                                        <a href="{{ url('admin/eventhapus/' . $event->idevent) }}" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?')">Hapus</a> --}}
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
