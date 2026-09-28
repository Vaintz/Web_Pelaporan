<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Sistem Pelaporan UNIMAL</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #e0e6ed;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 900px;
            min-height: 560px;
            background: white;
            border-radius: 30px;
            overflow: hidden;
            display: flex;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        }

        .left {
            width: 50%;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            width: 85px;
            margin-bottom: 25px;
        }

        .left h1 {
            font-size: 32px;
            color: #1f1f2e;
            margin-bottom: 15px;
        }

        .left p {
            color: #737783;
            line-height: 1.7;
            font-size: 15px;
        }

        .right {
            width: 50%;
            background: #1f1f2e;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right h2 {
            color: white;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .description {
            color: #a7a8b2;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            color: white;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper input {
            width: 100%;
            height: 50px;
            border: 1px solid #454556;
            border-radius: 10px;
            background: #292938;
            color: white;
            padding: 0 45px 0 15px;
            outline: none;
            font-size: 14px;
        }

        .input-wrapper input:focus {
            border-color: #a0aec0;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #aaa;
            padding: 3px;
        }

        .toggle-password svg {
            width: 20px;
            height: 20px;
        }

        .error {
            color: #ff8f8f;
            font-size: 13px;
            margin-top: 6px;
        }

        .status {
            background: #293b34;
            color: #9ee6c5;
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .button {
            width: 100%;
            height: 50px;
            border: none;
            border-radius: 10px;
            background: #a0aec0;
            color: #1f1f2e;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 5px;
        }

        .button:hover {
            background: #b5c0ce;
        }

        .back {
            text-align: center;
            margin-top: 22px;
        }

        .back a {
            color: #a0aec0;
            text-decoration: none;
            font-size: 14px;
        }

        .back a:hover {
            text-decoration: underline;
        }

        @media (max-width: 700px) {
            .card {
                flex-direction: column;
            }

            .left,
            .right {
                width: 100%;
            }

            .left {
                padding: 40px 30px;
            }

            .right {
                padding: 40px 30px;
            }
        }
    </style>
</head>

<body>

<div class="card">

    <div class="left">

        <img
            src="{{ asset('images/logo-unimal.png') }}"
            alt="Logo UNIMAL"
            class="logo"
        >

        <h1>Reset Password</h1>

        <p>
            Silakan buat password baru untuk akun
            Sistem Pelaporan Universitas Malikussaleh.
        </p>

    </div>


    <div class="right">

        <h2>Password Baru</h2>

        <p class="description">
            Masukkan password baru Anda dan konfirmasi password tersebut.
        </p>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">

            @csrf

            <input
                type="hidden"
                name="token"
                value="{{ $token }}"
            >

            <div class="input-group">

                <label for="email">
                    Email
                </label>

                <div class="input-wrapper">

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ $email }}"
                        required
                        readonly
                    >

                </div>

            </div>


            <div class="input-group">

                <label for="password">
                    Password Baru
                </label>

                <div class="input-wrapper">

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password baru"
                        required
                    >

                    <button
                        type="button"
                        class="toggle-password"
                        onclick="togglePassword('password', this)"
                    >
                        <svg viewBox="0 0 24 24" fill="none"
                            stroke="currentColor"
                            stroke-width="2">
                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>

                </div>

            </div>


            <div class="input-group">

                <label for="password_confirmation">
                    Konfirmasi Password
                </label>

                <div class="input-wrapper">

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Ulangi password baru"
                        required
                    >

                    <button
                        type="button"
                        class="toggle-password"
                        onclick="togglePassword('password_confirmation', this)"
                    >
                        <svg viewBox="0 0 24 24" fill="none"
                            stroke="currentColor"
                            stroke-width="2">
                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>

                </div>

            </div>


            <button type="submit" class="button">
                Reset Password
            </button>

        </form>


        <div class="back">
            <a href="{{ route('login') }}">
                Kembali ke Login
            </a>
        </div>

    </div>

</div>


<script>
    function togglePassword(id, button) {

        const input = document.getElementById(id);

        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }
</script>

</body>
</html>