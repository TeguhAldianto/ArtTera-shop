@extends('layouts.app')

@section('title', 'Home - ArtTera 2026')

@section('content')
    <section class="home" id="home">
        <div class="swiper home-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide" style="background: url('{{ asset('images/home-bg-1.jpg') }}') no-repeat;">
                    <div class="content">
                        <span class="subtitle">New Arrival 2026</span>
                        <h1 class="floating">The Future of <br> Digital Collecting</h1>
                        <p>Discover exclusive digital masterpieces, limited editions, and rare collectibles in our premium marketplace.</p>

                        <div class="hero-buttons">
                            <a href="{{ url('/gallery') }}" class="btn">
                                <i class="fas fa-rocket mr-2"></i> Explore Now
                            </a>
                            <a href="{{ url('/about') }}" class="glass-btn">
                                <i class="fas fa-play mr-2"></i> Learn More
                            </a>
                        </div>

                        <div class="hero-stats">
                            <div class="stat-item">
                                <strong>10k+</strong>
                                <span>Artworks</span>
                            </div>
                            <div class="stat-item">
                                <strong>5k+</strong>
                                <span>Artists</span>
                            </div>
                            <div class="stat-item">
                                <strong>100%</strong>
                                <span>Secure</span>
                            </div>
                        </div>
                    </div>

                    <div class="image">
                        <img src="{{ asset('images/home-img-1.jpg') }}" alt="Hero Art" class="floating-img">
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section class="services">
        <div class="service-container">
            <div class="service-box">
                <i class="fas fa-shield-alt icon"></i>
                <h3>Verified Authentic</h3>
                <p>Setiap karya terverifikasi asli oleh kurator ahli kami.</p>
            </div>
            <div class="service-box">
                <i class="fas fa-bolt icon"></i>
                <h3>Instant Delivery</h3>
                <p>Akses aset digital Anda secara instan setelah pembayaran.</p>
            </div>
            <div class="service-box">
                <i class="fas fa-globe icon"></i>
                <h3>Global Market</h3>
                <p>Terhubung dengan kolektor seni dari seluruh dunia.</p>
            </div>
        </div>
    </section>

    <section class="products">
        <div class="section-header">
            <h1 class="title">Curated Collections</h1>
            <p class="section-subtitle">Handpicked digital assets for your collection</p>
        </div>

        <div class="box-container">
            @foreach ($all_products as $product)
                <form action="{{ route('cart.add', $product->id) }}" method="post" class="product-card">
                    @csrf

                    <div class="badge">New Drop</div>

                    <div class="image-wrapper">
                        <img src="{{ asset('uploaded_img/' . $product->image) }}" alt="{{ $product->name }}">

                        <div class="overlay-actions">
                            <a href="{{ route('products.show', $product->id) }}" class="action-btn" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button type="submit" name="add_to_cart" class="action-btn" title="Add to Cart">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-content">
                        <a href="#" class="category-tag">{{ $product->category }}</a>
                        <h3 class="name">{{ $product->name }}</h3>

                        <div class="price-row">
                            <div class="price">
                                <span class="currency">Rp</span>
                                {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                            <div class="qty-control">
                                <input type="number" name="qty" class="qty-input" min="1" max="99" value="1">
                            </div>
                        </div>
                    </div>
                </form>
            @endforeach

            @if ($all_products->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <p>Belum ada koleksi terbaru saat ini.</p>
                </div>
            @endif
        </div>

        <div class="more-btn">
            <a href="{{ url('/gallery') }}" class="btn btn-outline">
                View All Collection <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </section>

    <section class="newsletter">
        <div class="newsletter-content">
            <h2>Join the Inner Circle</h2>
            <p>Subscribe untuk mendapatkan update eksklusif tentang "Drop" terbaru dan penawaran spesial.</p>
            <form action="" class="newsletter-form">
                <input type="email" placeholder="Enter your email address">
                <button type="button" class="btn">Subscribe</button>
            </form>
        </div>
    </section>
@endsection

{{-- CSS KHUSUS HALAMAN INI --}}
@push('styles')
<style>
    /* --- HERO SECTION --- */
    .home-slider .slide {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 4rem;
        padding-top: 6rem;
        padding-bottom: 6rem;
    }

    .subtitle {
        color: var(--main-color);
        font-size: 1.6rem;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        display: block;
        margin-bottom: 1rem;
    }

    .home-slider .content h1 {
        font-size: 5rem;
        line-height: 1.1;
        margin-bottom: 2rem;
        color: var(--black);
    }

    .home-slider .content p {
        font-size: 1.6rem;
        color: var(--light-color);
        line-height: 1.8;
        margin-bottom: 3rem;
        max-width: 500px;
    }

    .hero-buttons {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 4rem;
    }

    .glass-btn {
        display: inline-block;
        padding: 1rem 3rem;
        font-size: 1.6rem;
        border: 2px solid var(--black);
        color: var(--black);
        border-radius: 50px;
        font-weight: 500;
    }
    .glass-btn:hover {
        background: var(--black);
        color: var(--white);
    }

    .hero-stats {
        display: flex;
        gap: 4rem;
        border-top: 1px solid rgba(0,0,0,0.1);
        padding-top: 2rem;
    }

    .stat-item strong {
        display: block;
        font-size: 2.5rem;
        color: var(--black);
    }

    .stat-item span {
        font-size: 1.4rem;
        color: var(--light-color);
    }

    .floating-img {
        animation: float 6s ease-in-out infinite;
        border-radius: 20px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.15);
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }

    /* --- SERVICES GRID --- */
    .services {
        padding-top: 0;
        margin-top: -5rem;
        position: relative;
        z-index: 10;
    }

    .service-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .service-box {
        background: var(--white);
        padding: 3rem;
        border-radius: var(--radius);
        box-shadow: var(--box-shadow);
        text-align: center;
        transition: 0.3s;
        border: var(--border);
    }

    .service-box:hover {
        transform: translateY(-10px);
        border-bottom: 3px solid var(--main-color);
    }

    .service-box .icon {
        font-size: 3.5rem;
        color: var(--main-color);
        margin-bottom: 1.5rem;
        background: rgba(212, 175, 55, 0.1);
        padding: 1.5rem;
        border-radius: 50%;
    }

    /* --- PRODUCT CARDS (PREMIUM) --- */
    .section-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    .section-subtitle {
        font-size: 1.6rem;
        color: var(--light-color);
    }

    .product-card {
        background: var(--white);
        border-radius: 15px;
        box-shadow: var(--box-shadow);
        overflow: hidden;
        position: relative;
        transition: all 0.3s ease;
        border: var(--border);
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    .product-card .badge {
        position: absolute;
        top: 1.5rem;
        left: 1.5rem;
        background: var(--black);
        color: var(--white);
        padding: 0.5rem 1.2rem;
        font-size: 1.2rem;
        border-radius: 20px;
        z-index: 2;
    }

    .image-wrapper {
        position: relative;
        overflow: hidden;
        height: 28rem;
    }

    .image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Pastikan gambar memenuhi kotak */
        transition: 0.5s;
    }

    .product-card:hover .image-wrapper img {
        transform: scale(1.1); /* Zoom effect saat hover */
    }

    .overlay-actions {
        position: absolute;
        bottom: -50px; /* Sembunyi di bawah */
        left: 0; right: 0;
        display: flex;
        justify-content: center;
        gap: 1rem;
        padding: 1.5rem;
        background: linear-gradient(to top, rgba(0,0,0,0.5), transparent);
        transition: 0.3s;
        opacity: 0;
    }

    .product-card:hover .overlay-actions {
        bottom: 0;
        opacity: 1;
    }

    .action-btn {
        background: var(--white);
        color: var(--black);
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        cursor: pointer;
        transition: 0.2s;
    }

    .action-btn:hover {
        background: var(--main-color);
        color: var(--white);
    }

    .card-content {
        padding: 2rem;
    }

    .category-tag {
        font-size: 1.2rem;
        color: var(--main-color);
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 1px;
    }

    .product-card .name {
        font-size: 1.8rem;
        margin: 0.5rem 0 1.5rem;
        color: var(--black);
        font-weight: 700;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .price {
        font-size: 2rem;
        color: var(--black);
        font-weight: 700;
    }

    .price .currency {
        font-size: 1.4rem;
        font-weight: 400;
        vertical-align: top;
    }

    .qty-input {
        width: 60px;
        padding: 0.5rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        text-align: center;
    }

    /* --- NEWSLETTER --- */
    .newsletter {
        background: var(--black);
        padding: 6rem 2rem;
        text-align: center;
        color: var(--white);
        margin-top: 5rem;
        border-radius: 20px;
        margin-left: 2rem;
        margin-right: 2rem;
    }

    .newsletter h2 {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: var(--white);
    }

    .newsletter p {
        font-size: 1.6rem;
        color: #aaa;
        margin-bottom: 3rem;
    }

    .newsletter-form {
        max-width: 500px;
        margin: 0 auto;
        display: flex;
        gap: 1rem;
    }

    .newsletter-form input {
        flex: 1;
        border-radius: 50px;
        border: none;
        padding-left: 2rem;
    }

    .newsletter-form .btn {
        margin-top: 0;
        background: var(--main-color);
        border: none;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .home-slider .content h1 { font-size: 3.5rem; }
        .hero-stats { display: none; }
        .newsletter-form { flex-direction: column; }
    }
</style>
@endpush

@push('scripts')
    <script>
        var swiper = new Swiper(".home-slider", {
            loop: true,
            effect: "fade", // Efek fade lebih elegan
            fadeEffect: { crossFade: true },
            grabCursor: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },
        });
    </script>
@endpush
