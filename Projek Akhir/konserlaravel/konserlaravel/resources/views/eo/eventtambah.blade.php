@extends('eo.templates.index')

@section('page-content')
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-coklat">
                    <h6 class="m-0 font-weight-bold text-white">Tambah Event</h6>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Tampilkan alert sukses jika ada --}}
                    @if (session('alert'))
                        <div class="alert alert-success">
                            {{ session('alert') }}
                        </div>
                    @endif
                    <form id="eventForm" method="post" enctype="multipart/form-data" action="{{ url('eo/eventtambahsimpan') }}">
                        @csrf
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control" name="judul" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="10" required></textarea>
                            <script>
                                CKEDITOR.replace('deskripsi');
                            </script>
                        </div>
                        <div class="form-group">
                            <label>Harga (Rp)</label>
                            <input type="number" class="form-control" name="harga" min="0" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Event</label>
                            <input type="date" class="form-control" name="tanggalevent" required>
                        </div>
                        <div class="form-group">
                            <label>Jam Event</label>
                            <input type="time" class="form-control" name="jamevent" required>
                        </div>
                        <div class="form-group">
                            <label>Lokasi Event</label>
                            <input type="text" class="form-control" name="lokasi" required>
                        </div>
                        <div class="form-group">
                            <label>Kuota</label>
                            <input type="number" class="form-control" name="kuota" min="1" required>
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" class="form-control" name="foto" required>
                        </div>

                        <button type="button" class="btn btn-secondary" onclick="confirmSave()">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmSave() {
            var confirmation = confirm("Apakah Anda yakin data yang Anda masukkan sudah benar?");
            if (confirmation) {
                document.getElementById("eventForm").submit(); // Submit the form
            }
        }
    </script>
@endsection