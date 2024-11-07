<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top py-3">
        <div class="container">
            <a href="#" class="navbar-brand">QuickMeals</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="/home" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="/about" class="nav-link">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="/contact" class="nav-link">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main Content -->
    <div class="container mt-5">
        @yield('content')
    </div>


    <!-- Footer -->
    <footer class="p-5 bg-dark text-white text-end position-relative">
        <section class="top-0 text-end " id="contact">
            <div class="container">
                        <h3 class="text-end mb-4 bg-dark">Kontak Kami</h3>
                        <ul class="list-group-flush lead bg-dark text-end ">
                            <li class="list-group-item bg-dark text-light fs-6">
                                <i class="bi bi-geo-alt"></i>
                                <span class="fw-bold">Lokasi:</span>
                                <br> Jl. Seni Rupa No.1, Dimana-mana
                            </li>
                            <li class="list-group-item bg-dark text-light fs-6">
                                <i class="bi bi-telephone"></i>
                                <span class="fw-bold">Telepon:</span>
                                <br> 0812-3456-7890
                            </li>
                            <li class="list-group-item bg-dark text-light fs-6">
                                <i class="bi bi-instagram"></i>
                                <span class="fw-bold">Instagram:</span>
                                <br>@quickmeals
                            </li>
                            <li class="list-group-item bg-dark text-light fs-6">
                                <i class="bi bi-envelope"></i>
                                <span class="fw-bold">E-Mail:</span>
                                <br>quickmeals24@gmail.com
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <p class="lead text-start">Copyright &copy; 2024 QuickMeals</p>
            <!-- <a href="#" class="position-absolute bottom-0 end-0 p-5">
                <i class="bi bi-arrow-up-circle h1"></i>
            </a> -->
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
