@extends('home.templates.index')

@section('page-content')
    <style>
        .ra-event-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: white;
        }

        .ra-event-card:hover {
            transform: scale(1.03);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .ra-event-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .ra-event-card a {
            text-decoration: none;
            color: inherit;
        }

        .ra-event-card .ra-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin: 10px 0;
            line-height: 1.4;
        }

        .ra-event-card .ra-date,
        .ra-event-card .ra-location,
        .ra-event-card .ra-price {
            font-size: 0.9rem;
            color: #777;
            margin: 5px 0;
        }

        .ra-event-card .ra-price {
            font-weight: bold;
            color: #55acce;
        }

        .ra-event-card .ra-location {
            line-height: 1.4;
        }

        .ra-line {
            border-top: 1px solid #eee;
            margin: 10px 0;
        }
    </style>

    <section class="ftco-section">
        <div class="container">
            <div class="mb-5 text-center">
                <h1 style="color: black; font-weight:bold;">Daftar Event</h1>
                <p style="color: black;">Jelajahi berbagai event menarik!</p>
                <form action="{{ url('home/search') }}" method="GET" class="form-inline justify-content-center">
                    <input type="text" name="query" class="form-control mr-2" placeholder="Cari event..." required>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
                <form action="{{ url('home/filter') }}" method="GET" class="form-inline justify-content-center mt-3">
                    <input type="date" name="event_date" class="form-control mr-2" required>
                    <button type="submit" class="btn btn-secondary">
                        <i class="bi bi-funnel-fill"></i> <!-- Ikon funnel untuk filter -->
                    </button>
                </form>                
            </div>
            <div class="row">
                @foreach ($events as $event)
                    <div class="col-md-4">
                        <div class="ra-event-card">
                            <a href="{{ url('home/detail/' . $event->idevent) }}" rel="noopener noreferrer">
                                <!-- Event Image -->
                                <div>
                                    <img src="{{ asset('foto/' . $event->foto) }}" alt="{{ $event->judul }}">
                                </div>
                                <!-- Event Details -->
                                <div class="p-3">
                                    <p class="ra-title"> {{ \Illuminate\Support\Str::limit($event->judul, 20, '...') }}
                                    </p>
                                    <p class="ra-date">{{ tanggal($event->tanggalevent) }}</p>
                                    <p class="ra-location"> {{ \Illuminate\Support\Str::limit($event->lokasi, 25, '...') }}
                                    </p>
                                    <p class="ra-kuota">Kuota: {{ $event->kuota }} orang</p>
                                </div>
                                <hr class="ra-line">
                                <!-- Event Price -->
                                <div class="p-3 d-flex justify-content-between">
                                    <p class="ra-price-text">Mulai Dari</p>
                                    <p class="ra-price">Rp {{ number_format($event->harga, 0, ',', '.') }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection
