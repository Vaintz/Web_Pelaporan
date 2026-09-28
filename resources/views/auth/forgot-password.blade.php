<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lupa Password - Sistem Pelaporan</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;

            background-color: #e0e6ed;

            font-family:
                "Segoe UI",
                Tahoma,
                Geneva,
                Verdana,
                sans-serif;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 20px;
        }


        /* =========================================
           CARD
        ========================================= */

        .forgot-card {
            width: 100%;
            max-width: 500px;

            background: #ffffff;

            padding: 50px;

            border-radius: 30px;

            box-shadow:
                0 10px 25px rgba(0, 0, 0, 0.10);
        }


        /* =========================================
           HEADER
        ========================================= */

        .forgot-header {
            text-align: center;

            margin-bottom: 30px;
        }


        .forgot-header h1 {
            margin: 0 0 10px;

            color: #212035;

            font-size: 26px;

            font-weight: 700;
        }


        .forgot-header p {
            margin: 0;

            color: #718096;

            font-size: 13px;

            line-height: 1.6;
        }


        /* =========================================
           ERROR
        ========================================= */

        .alert-error {
            margin-bottom: 20px;

            padding: 12px 15px;

            background: #f8d7da;

            color: #842029;

            border-radius: 10px;

            font-size: 12px;
        }


        .alert-error ul {
            margin: 0;

            padding-left: 18px;
        }


        /* =========================================
           SUCCESS
        ========================================= */

        .alert-success {
            margin-bottom: 20px;

            padding: 12px 15px;

            background: #d1fae5;

            color: #065f46;

            border-radius: 10px;

            font-size: 12px;

            line-height: 1.5;
        }


        /* =========================================
           FORM
        ========================================= */

        .form-group {
            margin-bottom: 20px;
        }


        .form-label {
            display: block;

            margin-bottom: 8px;

            color: #212035;

            font-size: 12px;

            font-weight: 700;
        }


        .input-wrapper {
            position: relative;
        }


        .input-icon {
            position: absolute;

            left: 15px;
            top: 50%;

            transform: translateY(-50%);

            width: 18px;
            height: 18px;

            color: #4A5568;

            z-index: 2;
        }


        .input-icon svg {
            width: 100%;
            height: 100%;

            fill: currentColor;
        }


        .form-input {
            width: 100%;

            height: 48px;

            padding: 0 15px 0 45px;

            border: none;

            border-radius: 12px;

            background: #eef2f3;

            color: #212035;

            font-family: inherit;

            font-size: 13px;

            outline: none;
        }


        .form-input::placeholder {
            color: #a0aec0;
        }


        .form-input:focus {
            outline: 2px solid #a0aec0;
        }


        /* =========================================
           BUTTON
        ========================================= */

        .btn-submit {
            width: 100%;

            height: 48px;

            border: none;

            border-radius: 30px;

            background: #212035;

            color: #ffffff;

            font-family: inherit;

            font-size: 13px;

            font-weight: 700;

            cursor: pointer;

            transition: 0.2s ease;
        }


        .btn-submit:hover {
            opacity: 0.9;
        }


        /* =========================================
           BACK TO LOGIN
        ========================================= */

        .back-login {
            display: block;

            margin-top: 20px;

            text-align: center;

            color: #212035;

            font-size: 12px;

            text-decoration: underline;
        }


        .back-login:hover {
            opacity: 0.7;
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 600px) {

            body {
                padding: 15px;
            }

            .forgot-card {
                padding: 35px 25px;

                border-radius: 25px;
            }

            .forgot-header h1 {
                font-size: 23px;
            }

        }
    </style>
</head>


<body>


    <div class="forgot-card">


        <!-- =====================================
             HEADER
        ====================================== -->

        <div class="forgot-header">

            <h1>
                Lupa Password?
            </h1>

            <p>
                Masukkan email akun Anda. Kami akan mengirimkan
                link untuk mengatur ulang password.
            </p>

        </div>


        <!-- =====================================
             PESAN BERHASIL
        ====================================== -->

        @if (session('status'))

            <div class="alert-success">
                {{ session('status') }}
            </div>

        @endif


        <!-- =====================================
             ERROR
        ====================================== -->

        @if ($errors->any())

            <div class="alert-error">

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <!-- =====================================
             FORM
        ====================================== -->

        <form
            action="{{ route('password.email') }}"
            method="POST"
        >

            @csrf


            <!-- EMAIL -->

            <div class="form-group">

                <label
                    for="email"
                    class="form-label"
                >
                    Email
                </label>


                <div class="input-wrapper">

                    <span class="input-icon">

                        <svg viewBox="0 0 24 24">

                            <path
                                d="M3 5h18v14H3V5zm2 2v.5l7 5
                                7-5V7l-7 5-7-5z"
                            />

                        </svg>

                    </span>


                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email @unimal.ac.id"
                        required
                    >

                </div>

            </div>


            <!-- SUBMIT -->

            <button
                type="submit"
                class="btn-submit"
            >
                KIRIM LINK RESET PASSWORD
            </button>

        </form>


        <!-- =====================================
             KEMBALI KE LOGIN
        ====================================== -->

        <a
            href="{{ route('login') }}"
            class="back-login"
        >
            Kembali ke Login
        </a>


    </div>


</body>

</html>