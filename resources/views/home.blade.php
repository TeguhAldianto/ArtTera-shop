@extends('layouts.app')
@section('title', 'Home - ArtTera')

@section('content')
    <section class="home">
        <div class="swiper home-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide">
                    <div class="content">
                        <h1>Time To Find Your Favorite Things</h1>
                        <h3>Digital marketplace for arts collectibles. Buy, Sell, and discover exclusive assets.</h3>
                        <a href="{{ url('/gallery') }}" class="btn">see more</a>
                    </div>
                    <div class="image">
                        <img src="{{ asset('images/home-img-1.jpg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section class="products">
        <h1 class="title">Latest Products</h1>
        <div class="box-container">

            @foreach ($all_products as $product)
                <form action="{{ route('cart.add', $product->id) }}" method="post" class="box">
                    @csrf <a href="#" class="fas fa-eye"></a>
                    <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>

                    <img src="{{ asset('uploaded_img/' . $product->image) }}" alt="">

                    <a href="#" class="cat">{{ $product->category }}</a>

                    <div class="name">{{ $product->name }}</div>

                    <div class="flex">
                        <div class="price"><span>Rp.
                            </span>{{ number_format($product->price, 0, ',', '.') }}<span>/-</span></div>
                        <input type="number" name="qty" class="qty" min="1" max="99" value="1">
                    </div>
                </form>
            @endforeach

            @if ($all_products->isEmpty())
                <p class="empty">Belum ada produk yang ditambahkan!</p>
            @endif

        </div>

        <div class="more-btn">
            <a href="{{ url('/gallery') }}" class="btn">view all</a>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Mengaktifkan Slider Swiper khusus di halaman ini
        var swiper = new Swiper(".home-slider", {
            loop: true,
            grabCursor: true,
            effect: "flip",
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
@endpush
