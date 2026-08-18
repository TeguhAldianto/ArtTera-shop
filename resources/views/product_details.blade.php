@extends('layouts.app')
@section('title', $product->name . ' - Details')

@section('content')

<section class="product-details-container" style="padding: 6rem 2rem;">
    <div class="details-card" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 5rem; background: var(--white); padding: 4rem; border-radius: 20px; box-shadow: var(--box-shadow); border: var(--border);">

        <div class="image-box" style="text-align: center; overflow: hidden; border-radius: 15px; background: #f9f9f9; padding: 2rem;">
            <img src="{{ asset('uploaded_img/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: auto; object-fit: contain; max-height: 500px; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
        </div>

        <div class="content-box">
            <div class="badge" style="display: inline-block; background: var(--black); color: var(--white); padding: 0.6rem 1.8rem; border-radius: 50px; font-size: 1.4rem; font-weight: 500; margin-bottom: 2rem; text-transform: uppercase; letter-spacing: 1px;">
                {{ $product->category }}
            </div>

            <h1 class="name" style="font-size: 4rem; margin-bottom: 1.5rem; color: var(--black); line-height: 1.1;">{{ $product->name }}</h1>

            <div class="price" style="font-size: 3rem; color: var(--main-color); font-weight: 700; margin-bottom: 3rem;">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </div>

            <div class="description-box" style="margin-bottom: 4rem;">
                <h3 style="font-size: 1.8rem; margin-bottom: 1rem; color: var(--black);">Description</h3>
                <p class="description" style="font-size: 1.6rem; color: var(--light-color); line-height: 1.8;">
                    Produk eksklusif dari koleksi ArtTera. Dapatkan segera sebelum kehabisan.
                </p>
            </div>

            <form action="{{ route('cart.add', $product->id) }}" method="post" style="border-top: 1px solid #eee; padding-top: 3rem;">
                @csrf
                <div class="flex" style="display: flex; gap: 2rem; align-items: center; margin-bottom: 2rem;">
                    <div class="qty-wrapper" style="position: relative;">
                        <span style="position: absolute; top: -10px; left: 0; font-size: 1.2rem; color: var(--light-color);">Quantity</span>
                        <input type="number" name="qty" class="qty" min="1" max="99" value="1" style="width: 100px; padding: 1.5rem; border: 1px solid #ddd; border-radius: 12px; font-size: 1.8rem; text-align: center; font-weight: bold;">
                    </div>

                    <button type="submit" class="btn" style="margin-top: 0; flex: 1; height: 55px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem;">
                        <i class="fas fa-shopping-bag" style="margin-right: 1rem;"></i> Add to Cart
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
