

@extends('home.templates.index')

@section('page-content')
   
    <section class="ftco-section">
        <div class="container">
        <h1 class="my-4">Event Favorit Anda</h1>

        @if ($favorit->isEmpty())
            <p>Anda belum menambahkan event ke favorit.</p>
        @else
            <div class="row">
                @foreach ($favorit as $event)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('foto/' . $event->foto) }}" class="card-img-top" alt="{{ $event->judul }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->judul }}</h5>
                                <p class="card-text">{!! Str::limit($event->deskripsi, 100) !!}</p>
                                <a href="{{ url('home/detail/' . $event->idevent) }}" class="btn btn-primary">Lihat Detail</a>
                                <form method="post" action="{{ url('home/hapusFavorit') }}" class="mt-3">
                                    @csrf
                                    <input type="hidden" name="idevent" value="{{ $event->idevent }}">
                                    <button class="btn btn-danger" name="hapusFavorit">Hapus dari Favorit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    </section>
@endsection

    

