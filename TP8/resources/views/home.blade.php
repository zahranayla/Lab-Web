@extends('layouts.master')

@section('title', 'Home')

@section('content')
<style>
.text-danger-emphasis {
    color: #dc3545; 
    opacity: 0.7; 
}

.custom-bg {
    background-color: #ccd1db;
    width: 100vw; 
    margin-left: calc((100% - 100vw) / 2); 
}
</style>

<section class="custom-bg text-dark text-center text-sm-start pt-5 pb-4 pb-lg-0 mt-5">
    <div class="container">
        <div class="d-flex align-items-center">  
            <div>
                <h1>Selamat Datang di <span class="text-danger-emphasis">Quick Meals</span></h1>
                <p class="lead">Simple Recipes, Great Taste!</p>
                <button onclick="window.location='{{ route('about') }}'" class="btn btn-primary btn-lg">
                    Jelajahi QuickMeals
                </button>
            </div>
            <img class="img-fluid w-50 d-none d-sm-block" src="images/home.svg" alt="header">
        </div>
    </div>
</section>

@endsection
