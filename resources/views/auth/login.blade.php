<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ url('asset/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <div class="wrapper">

        <div class="form-box login">
            <h2>Login</h2>
            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                @if (session('success'))
                    <p class="">
                        {{ session('success') }}
                    </p>
                @endif
                @foreach ($errors->all() as $error)
                    <p style="color: red">{{ $error }}</p>
                @endforeach
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" id="email" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"> <i class="fa-solid fa-lock"></i></span>
                    <input type="password" id="password" name="password" required>
                    <label>Password</label>
                </div>
                {{-- <div class="remember-forgot">
                    <label><input type="checkbox">Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div> --}}
                <button type="submit" class="btn">Login</button>
                <div class="login-register">
                    <p>Belum punya akun? <a href="#" class="register-link">Register</a></p>
                </div>
            </form>
        </div>

        <div class="form-box register">
            <h2>Registrasi</h2>
            <form action="{{ route('login.register') }}" method="POST">
                @csrf
                @foreach ($errors->all() as $error)
                    <p style="color: red">{{ $error }}</p>
                @endforeach
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="nama_register" required>
                    <label>Nama Lengkap</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="username_register" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email_register" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"> <i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password_register1" required>
                    <label>Password</label>
                </div>
                <div class="input-box">
                    <span class="icon"> <i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password_register2" required>
                    <label>Konfirmasi Password</label>
                </div>
                {{-- <div class="remember-forgot">
                    <label><input type="checkbox">Saya setuju dengan ketentuan berlaku</label>
                </div> --}}
                <button type="submit" class="btn">Register</button>
                <div class="login-register">
                    <p>Sudah punya akun? <a href="#" class="login-link">Login</a></p>

            </form>
        </div>
    </div>

</body>

</html>


<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Jost', sans-serif;
        /* font-family: "Open Sans", sans-serif; */
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: url('img.png') no-repeat;
        background-size: cover;
        /* background-position: center; */
        /* backdrop-filter: blur(2px); */
    }

    .wrapper {
        position: relative;
        width: 350px;
        height: 400px;
        background: transparent;
        border: 2px solid rgba(255, 255, 255, .5);
        border-radius: 20px;
        backdrop-filter: blur(10px);
        box-shadow: 0 0 30px rgba(0, 0, 0, .5);
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        /* transform: scale(0); */
        transition: height .2s ease;
        /* transition: transform .5s ease, height .2s ease; */
    }

    .wrapper.active {
        height: 480px;
    }

    .wrapper .form-box {
        width: 100%;
        padding: 40px;
    }

    .wrapper .form-box.login {
        transition: transform .18s ease;
        transform: translateX(0);
    }

    .wrapper.active .form-box.login {
        transition: none;
        transform: translateX(-400px);

    }

    .wrapper .form-box.register {
        position: absolute;
        transition: none;
        transform: translateX(400px);
    }

    .wrapper.active .form-box.register {
        transition: transform .18s ease;
        transform: translateX(0);
    }


    .form-box h2 {
        font-size: 2.1em;
        color: #030303;
        text-align: center;
    }

    .input-box {
        position: relative;
        width: 100%;
        height: 50px;
        border-bottom: 2px solid #162938;
        margin: 30px 0;
    }

    .input-box label {
        position: absolute;
        top: 50%;
        left: 5px;
        transform: translateY(-50%);
        font-size: 1.1em;
        color: #030303;
        font-weight: 500;
        pointer-events: none;
        transition: .5s;
    }

    .input-box input:focus~label,
    .input-box input:valid~label {
        top: -5px;
    }

    .input-box input {
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        font-size: 1.1em;
        color: #030303;
        font-weight: 600;
        padding: 0 35px 0 5px;
    }

    .input-box .icon {
        position: absolute;
        right: 8px;
        font-size: 1.2em;
        color: #030303;
        line-height: 57px;

    }

    .remember-forgot {
        font-size: 1em;
        color: #000305;
        font-weight: 500;
        margin: -15px 0 15px;
        display: flex;
        justify-content: space-between;
    }

    .remember-forgot label input {
        accent-color: #000305;
        margin-right: 3px;
    }

    .remember-forgot a {
        color: #000305;
        text-decoration: none;
    }

    .remember-forgot a:hover {
        text-decoration: underline;
    }

    .btn {
        width: 100%;
        height: 40px;
        background: #000305;
        border: none;
        outline: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 1em;
        color: #fff;
        font-weight: 500;
    }

    .login-register {
        font-size: 1em;
        color: #000305;
        text-align: center;
        font-weight: 500;
        margin: 20px 0 10px;
    }

    .login-register p a {
        color: #000305;
        text-decoration: none;
        font-weight: 600;
    }

    .login-register p a:hover {
        text-decoration: underline;
    }
</style>

<script>
    const wrapper = document.querySelector('.wrapper');
    const loginLink = document.querySelector('.login-link');
    const registerLink = document.querySelector('.register-link');
    // const btn = document.querySelector('.btnLogin');
    // const iconClose = document.querySelector('.icon-close');

    registerLink.addEventListener('click', () => {
        wrapper.classList.add('active');
    });

    loginLink.addEventListener('click', () => {
        wrapper.classList.remove('active');
    });

    // btn.addEventListener('click', () => {
    //     wrapper.classList.add('active-btn');
    // });

    // iconClose.addEventListener('click', () => {
    //     wrapper.classList.remove('active-btn');
    // });
</script>
