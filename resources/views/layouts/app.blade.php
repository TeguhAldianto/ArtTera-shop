<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ArtTera')</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <header class="header">
        <section class="flex">
            <a href="{{ url('/') }}" class="logo">ArtTera<span>.</span></a>

            <nav class="navbar">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ url('/about') }}">About</a>
                <a href="{{ url('/gallery') }}">Gallery</a>
                <a href="{{ url('/orders') }}">Orders</a>
                <a href="{{ url('/contact') }}">Contact</a>
            </nav>

            <div class="icons">
                <a href="{{ url('/search') }}" aria-label="Search"><i class="fas fa-search" aria-hidden="true"></i></a>

                @php
                    $cartCount = 0;
                    if(Auth::check()){
                        $cartCount = \App\Models\Cart::where('user_id', Auth::id())->count();
                    }
                @endphp

                <a href="{{ url('/cart') }}" aria-label="Shopping Cart"><i class="fas fa-shopping-cart" aria-hidden="true"></i><span>({{ $cartCount }})</span></a>
                <button type="button" id="user-btn" aria-label="User Profile" class="fas fa-user" style="background:none;border:none;cursor:pointer;font-size:inherit;color:inherit;"></button>
                <button type="button" id="menu-btn" aria-label="Menu" class="fas fa-bars" style="background:none;border:none;cursor:pointer;font-size:inherit;color:inherit;"></button>
            </div>

            <div class="profile">
                @auth
                    {{-- PERBAIKAN: Definisi variabel $user agar editor tidak error --}}
                    @php
                        /** @var \App\Models\User $user */
                        $user = Auth::user();
                    @endphp

                    <p class="name">{{ $user->name }}</p>
                    <div class="flex">
                        <a href="{{ route('profile') }}" class="btn">Profile</a>

                        <form action="{{ route('logout') }}" method="post" style="display:inline; width:100%;">
                            @csrf
                            <button type="submit" class="delete-btn" style="width:100%;">Logout</button>
                        </form>
                    </div>
                @endauth

                @guest
                    <p class="name">Guest Account</p>
                    <p class="account">
                        <a href="{{ route('login') }}">Login</a> or
                        <a href="{{ route('register') }}">Register</a>
                    </p>
                @endguest
            </div>
        </section>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <section class="box-container">
            <div class="box">
                <i class="fas fa-envelope"></i>
                <h3>Our Email</h3>
                <a href="mailto:artteramarket@gmail.com">artteramarket@gmail.com</a>
            </div>
            <div class="box">
                <i class="fas fa-clock"></i>
                <h3>Opening Hours</h3>
                <p>24 Hours Online</p>
            </div>
            <div class="box">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Our Address</h3>
                <a href="#">Jawa Timur, Indonesia</a>
            </div>
            <div class="box">
                <i class="fas fa-phone"></i>
                <h3>Phone Number</h3>
                <a href="tel:1234567890">+62 888-8888-8888</a>
            </div>
        </section>
        <div class="credit">© 2026 <span>ArtTera</span> | All Rights Reserved</div>
    </footer>

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    @stack('scripts')
</body>

</html>
