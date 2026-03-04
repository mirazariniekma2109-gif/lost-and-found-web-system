<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Lost & Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-color: #e2e8f0; 
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        .main-container {
            display: flex;
            width: 1000px;
            height: 650px; /* Tinggikan sikit sebab semua elemen dah gergasi */
            background: white;
            border-radius: 30px; 
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        /* BAHAGIAN KIRI */
        .left-side {
            width: 50%;
            background: url("{{ asset('images/leftside.jpeg') }}") no-repeat center center;
            background-size: cover;
        }

        /* BAHAGIAN KANAN */
        .right-side {
            width: 50%;
            padding: 20px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center; 
            text-align: center;
            align-items: center;
        }

        /* LOGO - Saiz besar dan tarik tulisan bawah naik */
        .logo-container {
            margin-bottom: -35px; /* Hempap tulisan bawah ke logo */
            z-index: 1;
        }

        .logo-style {
            width: 330px; /* Saiz gergasi */
            height: auto;
        }

        /* TULISAN - Saiz besar dan rapat */
        .welcome-title {
            font-size: 2.6rem; 
            font-weight: 900;
            color: #000;
            margin-bottom: -5px;
            line-height: 1.0;
            position: relative;
            z-index: 2;
        }

        .welcome-sub {
            font-size: 2.6rem;
            font-weight: 900;
            color: #000;
            margin-bottom: 15px;
            line-height: 1.0;
        }

        .description {
            color: #718096;
            font-size: 1.1rem;
            margin-bottom: 25px;
            line-height: 1.4;
            max-width: 360px;
        }

        /* BUTANG - Lebar, tebal dan besar */
        .btn-stack {
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: 100%;
            max-width: 340px; /* Butang lebih lebar */
        }

        .btn-custom {
            padding: 15px; /* Butang lebih tebal */
            border-radius: 12px;
            font-weight: 800;
            text-decoration: none;
            transition: 0.2s;
            border: none;
            color: white !important;
            font-size: 1.1rem; /* Tulisan butang besar */
            text-align: center;
            text-transform: uppercase;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-blue { background-color: #0077b6; }
        .btn-orange { background-color: #f37021; }

        .btn-custom:hover {
            opacity: 0.95;
            transform: scale(1.02);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .footer-tag {
            margin-top: 25px;
            font-size: 0.7rem;
            color: #a0aec0;
        }
    </style>
</head>
<body>

    <div class="main-container">
        <div class="left-side"></div>

        <div class="right-side">
            
            <div class="logo-container">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="logo-style">
            </div>

            <div class="welcome-title">Welcome to</div>
            <div class="welcome-sub">Lost & Found</div>
            
            <p class="description">
                Reconnect with your belongings. Fast , easy and secure.
            </p>

            <div class="btn-stack">
                <a href="{{ route('login') }}" class="btn-custom btn-blue">LOG IN</a>
                <a href="{{ route('register') }}" class="btn-custom btn-orange">SIGN UP</a>
            </div>

            <div class="footer-tag">© 2026 Lost & Found Platform.</div>
        </div>
    </div>

</body>
</html>