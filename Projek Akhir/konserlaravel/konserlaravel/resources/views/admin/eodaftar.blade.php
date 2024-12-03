@extends('admin.templates.index')

@section('page-content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="{{ url('admin/eotambah') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah EO
        </a>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-coklat">
                    <h6 class="m-0 font-weight-bold text-white">Daftar EO</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eos as $key => $eo)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $eo->nama }}</td>
                                    <td>{{ $eo->email }}</td>
                                    <td>{{ $eo->telepon }}</td>
                                    <td>{{ $eo->alamat }}</td>
                                    <td>
                                        <a href="{{ url('admin/eoedit/' . $eo->id) }}" class="btn btn-primary">Ubah</a>
                                        <a href="{{ url('admin/eohapus/' . $eo->id) }}" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus EO ini?')">Hapus</a>
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
