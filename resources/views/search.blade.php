@extends('layouts.app')
@section('title', 'Search Page')

@section('content')

    <section class="search-form">
        <form action="{{ route('search') }}" method="get">
            <input type="text" class="box" name="search_box" placeholder="search here..." maxlength="100"
                value="{{ $query ?? '' }}">
            <button type="submit" class="fas fa-search" name="search_btn"></button>
        </form>
    </section>

    <section class="products" style="padding-top: 0; min-height: 100vh;">

        <div class="box-container">

            @if (isset($products) && !$products->isEmpty())
                @foreach ($products as $product)
                    <form action="{{ route('cart.add', $product->id) }}" method="post" class="box">
                        @csrf
                        <a href="#" class="fas fa-eye"></a>
                        <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
                        <img src="{{ asset('uploaded_img/' . $product->image) }}" alt="">
                        <div class="name">{{ $product->name }}</div>
                        <div class="flex">
                            <div class="price"><span>Rp.
                                </span>{{ number_format($product->price, 0, ',', '.') }}<span>/-</span></div>
                            <input type="number" name="qty" class="qty" min="1" max="99"
                                value="1">
                        </div>
                    </form>
                @endforeach
            @elseif(isset($query))
                <p class="empty">Tidak ada produk yang ditemukan untuk "{{ $query }}"!</p>
            @else
                <p class="empty">Silakan cari sesuatu!</p>
            @endif

        </div>

    </section>

@endsection
