@extends('layouts.app')

@section('title', 'Gallery - ArtTera')

@section('content')

    <section class="products">
        <h1 class="title">All Products</h1>
        <div class="box-container">

            @foreach ($all_products as $product)
                <form action="{{ route('cart.add', $product->id) }}" method="post" class="box">
                    @csrf <a href="#" class="fas fa-eye"></a>
                    <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
                    <img src="{{ asset('uploaded_img/' . $product->image) }}" alt="">
                    <div class="name">{{ $product->name }}</div>
                    <div class="flex">
                        <div class="price"><span>Rp.
                            </span>{{ number_format($product->price, 0, ',', '.') }}<span>/-</span></div>
                        <input type="number" name="qty" class="qty" min="1" max="99" value="1">
                    </div>
                </form>
            @endforeach

        </div>
    </section>

@endsection
