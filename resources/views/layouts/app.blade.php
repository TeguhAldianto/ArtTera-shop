<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ArtTera')</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <header class="header">
        <section class="flex">
            <a href="{{ url('/') }}" class="logo">ArtTera</a>

            <nav class="navbar">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ url('/about') }}">About Us</a>
                <a href="{{ url('/gallery') }}">Gallery</a>
                <a href="{{ url('/orders') }}">Orders</a>
                <a href="{{ url('/contact') }}">Contact</a>
            </nav>

            <div class="icons">
                <a href="{{ url('/search') }}"><i class="fas fa-search"></i></a>
                <a href="{{ url('/cart') }}"><i class="fas fa-shopping-cart"></i><span>(3)</span></a>
                <div id="user-btn" class="fas fa-user"></div>
                <div id="menu-btn" class="fas fa-bars"></div>
            </div>

            <div class="profile">
                @auth
                    <p class="name">{{ Auth::user()->name }}</p>
                    <div class="flex">
                        <a href="{{ url('/profile') }}" class="btn">profile</a>

                        <form action="{{ route('logout') }}" method="post" style="display:inline;">
                            @csrf
                            <button type="submit" class="delete-btn" style="width:100%;">logout</button>
                        </form>
                    </div>
                @endauth

                @guest
                    <p class="name">Guest</p>
                    <p class="account">
                        <a href="{{ route('login') }}">login</a> or
                        <a href="{{ route('register') }}">register</a>
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
                <img src="{{ asset('images/email-icon.png') }}" alt="">
                <h3>our email</h3>
                <a href="mailto:artteramarket@gmail.com">artteramarket@gmail.com</a>
            </div>
            <div class="box">
                <img src="{{ asset('images/clock-icon.png') }}" alt="">
                <h3>opening hours</h3>
                <p>24 hours</p>
            </div>
            <div class="box">
                <img src="{{ asset('images/map-icon.png') }}" alt="">
                <h3>our address</h3>
                <a href="#">Jawa Timur, indonesia</a>
            </div>
            <div class="box">
                <img src="{{ asset('images/phone-icon.png') }}" alt="">
                <h3>our number</h3>
                <a href="tel:1234567890">+62 888-8888-8888</a>
            </div>
        </section>
        <div class="credit">© copyright @ 2025 by <span>ArtTera</span> | all rights reserved!</div>
    </footer>

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    @stack('scripts')
</body>

</html>
