@extends('home.templates.index')

@section('page-content')

    <head>
        <!-- Include Font Awesome CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <style>
        .ftco-intro {
            background-color: #b4ce55;
            /* Updated to new color */
        }

        .intro {
            background-color: white;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
        }

        .intro .icon {
            font-size: 90px;
            color: #10952d;
            /* Updated to new color */
            margin-bottom: 0px;
        }

        .intro .text {
            color: black;
        }

        .intro h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .intro p {
            font-size: 14px;
            margin: 0;
        }

        .best-product .product-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            margin-bottom: 20px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .best-product .product-card img {
            border-radius: 10px;
            margin-bottom: 10px;
            max-height: 200px;
            object-fit: cover;
        }

        .best-product .product-card h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .best-product .product-card .price {
            font-size: 14px;
            color: #55acce;
            font-weight: bold;
            margin-top: auto;
        }

        .best-product .product-card .sale {
            background-color: #55acce;
            /* Updated to new color */
            color: black;
            padding: 5px 10px;
            border-radius: 5px;
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-md-4 {
            flex: 1 1 33%;
            padding: 10px;
        }

        .latest-articles {
            padding: 50px 0;
        }

        .latest-articles .article-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            max-height: 600px;
        }

        .latest-articles .article-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .latest-articles .article-card .content {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .latest-articles .article-card h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .latest-articles .article-card p {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .latest-articles .article-card .read-more {
            font-size: 14px;
            color: #A38758;
            font-weight: bold;
            text-decoration: none;
        }

        .latest-articles .article-card .date {
            font-size: 12px;
            color: #999;
            margin-top: 10px;
        }
    </style>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('foto/bg2.png') }}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('foto/bg1.png') }}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('foto/bg3.png') }}" class="d-block w-100" alt="...">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


    <section class="best-product mt-5">
        <div class="container">
            <div>
                <h1 style="color: black; font-weight:bold;">Event</h1>
                <p style="color: black;">Pesan Sekarang Untuk Mendapatkan Penawaran Spesial!</p>
            </div>
            <div class="row">
                @foreach ($event as $e)
                    <div class="col-md-4">
                        <div class="product-card">
                            <img src="{{ asset('foto/' . $e->foto) }}" alt="{{ $e->judul }}">
                            <h3>{{ $e->judul }}</h3>
                            <p class="price">Rp {{ number_format($e->harga, 0, ',', '.') }}</p>
                            <a href="{{ url('home/detail/' . $e->idevent) }}" class="btn"
                                style="background-color:  #7e9c92">Lihat
                                Detail</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
