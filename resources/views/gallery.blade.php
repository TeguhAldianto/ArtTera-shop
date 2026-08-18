@extends('layouts.app')
@section('title', 'Exclusive Gallery - ArtTera')

@section('content')

    <section class="gallery-section">
        <div class="gallery-header" style="text-align: center; margin-bottom: 4rem;">
            <h1 class="title">Curated Collection</h1>
            <p style="font-size: 1.6rem; color: var(--light-color); max-width: 600px; margin: 0 auto;">
                Explore our premium selection of digital assets and physical masterpieces.
            </p>
        </div>

        <div class="filter-bar" style="display: flex; justify-content: center; gap: 1.5rem; margin-bottom: 4rem; flex-wrap: wrap;">
            <button class="btn" style="background: var(--black); color: var(--white);">All Items</button>
            <button class="btn" style="background: var(--white); color: var(--black); border: 1px solid #ddd;">Digital Art</button>
            <button class="btn" style="background: var(--white); color: var(--black); border: 1px solid #ddd;">Sculptures</button>
            <button class="btn" style="background: var(--white); color: var(--black); border: 1px solid #ddd;">Paintings</button>
        </div>

        <div class="box-container">
            @foreach ($all_products as $product)
                <form action="{{ route('cart.add', $product->id) }}" method="post" class="product-card">
                    @csrf

                    <div class="badge">{{ $product->category }}</div>

                    <div class="image-wrapper">
                        <img src="{{ asset('uploaded_img/' . $product->image) }}" alt="{{ $product->name }}">
                        <div class="overlay-actions">
                            <a href="#" class="action-btn"><i class="fas fa-eye"></i></a>
                            <button type="submit" name="add_to_cart" class="action-btn"><i class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div>

                    <div class="card-content">
                        <h3 class="name">{{ $product->name }}</h3>
                        <div class="price-row">
                            <div class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            <input type="number" name="qty" class="qty-input" min="1" max="99" value="1">
                        </div>
                    </div>
                </form>
            @endforeach
        </div>

        @if ($all_products->isEmpty())
            <div class="empty-state" style="text-align: center; padding: 5rem;">
                <i class="fas fa-box-open" style="font-size: 5rem; color: #ddd;"></i>
                <p style="font-size: 2rem; color: var(--light-color); margin-top: 1rem;">No masterpiece found.</p>
            </div>
        @endif
    </section>

@endsection
