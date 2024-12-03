<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
            margin-top: 50px;
        }

        .login-form h2 {
            margin-bottom: 20px;
        }

        .login-form .form-group label {
            font-weight: bold;
        }

        .btn-login {
            background-color: #55acce;
            color: #fff; 
            border: none;
        }

        .btn-login:hover {
            background-color: #4088a5;
        }

        .register-link,
        .forgot-password {
            margin-top: 10px;
            display: block;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="login-form">
                    <h2 class="text-center">Login</h2>
                    <p class="text-center">Silahkan melakukan login dengan menggunakan data Anda yang valid</p>
                    <form method="post" action="{{ url('home/dologin') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email*</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password*</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        {{-- <div class="form-group text-right">
                            <a href="#" class="forgot-password text-right" style="color: #55acce;">Lupa
                                Password?</a>
                        </div> --}}
                        <button type="submit" class="btn btn-login btn-block">Masuk</button>
                        <a href="/home/daftar" class="register-link" style="color: black;">Belum punya akun? <span
                                style="color: #55acce;">Registrasi</span></a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
