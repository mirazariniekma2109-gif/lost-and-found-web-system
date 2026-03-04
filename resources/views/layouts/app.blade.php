<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost & Found Platform</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f8fafc; 
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* NAVBAR KURUS & BIRU */
        .navbar { 
            background-color: #3178c6; 
            padding: 0.35rem 0; 
            min-height: 48px;
        }
        
        .navbar-brand { 
            font-weight: 800; 
            color: #ffffff !important; 
            font-size: 0.95rem; 
        }

        .navbar-brand span { font-weight: 300; opacity: 0.8; }

        .nav-link { 
            color: rgba(255, 255, 255, 0.9) !important; 
            font-size: 0.75rem; 
            font-weight: 500;
        }

        /* Garis bawah menu aktif */
        .nav-link.active {
            border-bottom: 2px solid white;
        }

        /* Ikon loceng & profile belah kanan */
        .nav-icons {
            display: flex;
            align-items: center;
            gap: 18px;
            color: white;
            margin-left: 15px;
        }

        /* DROPDOWN MENU: Jarak & Styling */
        .dropdown-menu {
            margin-top: 15px !important; /* Jarakkan dari navbar */
            border: none;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 8px 0;
            min-width: 160px;
        }

        .dropdown-item {
            font-size: 0.78rem;
            padding: 0.6rem 1.2rem;
            transition: 0.2s;
        }

        /* MAIN: Center Content */
        main { 
            flex-grow: 1; 
            display: flex;
            align-items: center; 
            justify-content: center;
            padding: 20px;
        }

        footer {
            font-size: 0.65rem;
            color: #94a3b8;
            padding: 0.8rem 0;
            text-align: center;
            background: white;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Lost & Found <span>PLATFORM</span>
            </a>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    </li>
                    
                    @auth
                        <li class="nav-item"><a class="nav-link {{ Request::is('lost*') ? 'active' : '' }}" href="{{ route('lost.create') }}">Report Lost Item</a></li>
                        <li class="nav-item"><a class="nav-link {{ Request::is('found*') ? 'active' : '' }}" href="{{ route('found.create') }}">Report Found Item</a></li>
                        <li class="nav-item"><a class="nav-link {{ Request::is('matches*') ? 'active' : '' }}" href="{{ route('matches.index') }}">My Matches</a></li>
                        
                        <div class="nav-icons">
                            <i class="bi bi-bell" style="font-size: 0.95rem; cursor: pointer;"></i>
                            
                            <div class="dropdown">
                                <i class="bi bi-person-circle dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.2rem; cursor: pointer;"></i>
                                
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                    
                                    
                                    <li><hr class="dropdown-divider" style="opacity: 0.05;"></li>
                                    
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="dropdown-item fw-bold" style="color: #f6ad55;">
                                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item ms-2">
                            <a class="btn btn-sm btn-light fw-bold" href="{{ route('register') }}" style="font-size: 0.7rem; padding: 2px 12px;">SIGN UP</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container">
            &copy; 2026 Lost & Found Platform. All Rights Reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>