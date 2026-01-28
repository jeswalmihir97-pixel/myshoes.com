<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->

    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
    }
       body {
        background-image: url("");
        background-size: cover;
        background-position: center;
        background-attachment: fixed; /* Makes background stay while scrolling */
        background-repeat: no-repeat;
    }

      body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        margin: 0;
        padding-top: 70px;
      }

      .navbar {
          background-color: rgb(28, 28, 216);
          position: fixed;
          width: 100%;
          top: 0;
          z-index: 1000;
          padding: 10px;
      }

      .navbar-nav .nav-link {
        color: #ffffff;
      }

      .navbar-nav .nav-link:hover {
        color: rgb(0, 0, 2);
      }

      .main-content {
        margin-top: 80px;
        flex-grow: 1;
      }

      .container {
        padding-top: 80px;
      }

      .profile-container {
          display: flex;
          align-items: center;
          gap: 10px;
      }

      .profile-img {
          width: 40px;
          height: 40px;
          border-radius: 50%;
          object-fit: cover;
          border: 2px solid white;
      }

      .dropdown-menu {
          background-color: rgb(28, 28, 216);
      }

      .dropdown-item {
          color: white;
      }

      .dropdown-item:hover {
          background-color: rgb(0, 0, 2);
      }

       /* Footer Styling */
    footer {
        background-color: #28282B;
        color: #ffffff;
        text-align: center;
        padding: 15px;
        margin-top: auto; /* Pushes footer to the bottom */
        width: 100%;
    }

    /* Footer links styling */
    footer a {
        color:rgb(14, 35, 226);
        text-decoration: none;
        margin: 0 10px;
        font-size: 20px;
    }

    footer a:hover {
        color: #ffffff;
    }
    </style>
</head>
<body>

<div class="content-wrapper">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}"><h3>Home</h3></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('mybooking') }}">My Booking</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About Us</a></li>
                </ul>

                <!-- Search Bar -->
                <form class="d-flex navbar-search-bar">
                    <input class="form-control me-2" type="text" placeholder="Search...">
                    <button class="btn btn-warning" type="button">Search</button>
                </form>
                <!-- Cart Icon with Item Count -->
                <a href="{{ route('cart.index') }}" class="btn btn-light position-relative ms-3">
                    <i class="fas fa-shopping-cart"></i>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>

                <!-- User Profile Section -->
                @auth
                <div class="dropdown ms-3">
                    <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                        <img src="{{ session('profile_image', asset('uploads/default-profile.png')) }}" alt="Profile" class="profile-img">
                        <span>{{ auth()->user()->username }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile') }}">View Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
            @endauth

                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-light ms-3">Login</a>
                @endguest
            </div>
        </div>
    </nav>

    <div class="main-content container mt-4">
        @yield('content')
    </div>

    <footer>
        <p>&copy; 2024 Your Company. All Rights Reserved.</p>
        <p>Follow us: 
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </p>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
