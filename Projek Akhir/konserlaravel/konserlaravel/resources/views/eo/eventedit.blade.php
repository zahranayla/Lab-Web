@extends('eo.templates.index')

@section('page-content')
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-coklat">
                    <h6 class="m-0 font-weight-bold text-white">Edit Event</h6>
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
                    <form id="eventEditForm" method="post" enctype="multipart/form-data"
                        action="{{ url('eo/eventeditsimpan/' . $event->idevent) }}">
                        @csrf
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control" name="judul" value="{{ $event->judul }}" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="10" required>{{ $event->deskripsi }}</textarea>
                            <script>
                                CKEDITOR.replace('deskripsi');
                            </script>
                        </div>
                        <div class="form-group">
                            <label>Harga (Rp)</label>
                            <input type="number" class="form-control" name="harga" value="{{ $event->harga }}"
                                min="0" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Event</label>
                            <input type="date" class="form-control" name="tanggalevent"
                                value="{{ $event->tanggalevent }}" required>
                        </div>
                        <div class="form-group">
                            <label>Jam Event</label>
                            <input type="time" class="form-control" name="jamevent" value="{{ $event->jamevent }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Lokasi Event</label>
                            <input type="text" class="form-control" name="lokasi" value="{{ $event->lokasi }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Kuota</label>
                            <input type="number" class="form-control" name="kuota" value="{{ $event->kuota }}" min="1" required>
                        </div>
                        <div class="form-group">
                            <label>Foto (Opsional)</label>
                            <div class="letak-input" style="margin-bottom: 10px;">
                                <input type="file" class="form-control" name="foto">
                            </div>
                            @if ($event->foto)
                                <img src="{{ asset('foto/' . $event->foto) }}" width="100px">
                            @endif
                        </div>

                        <button type="button" class="btn btn-secondary" onclick="confirmSave()">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmSave() {
            var confirmation = confirm("Apakah Anda yakin ingin menyimpan perubahan ini?");
            if (confirmation) {
                document.getElementById("eventEditForm").submit(); // Submit the form
            }
        }
    </script>
@endsection