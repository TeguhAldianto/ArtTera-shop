@extends('layouts.app')
@section('title', 'Your Cart')

@section('content')

    <section class="cart-section">
        <h1 class="title">Shopping Bag</h1>

        <div class="cart-layout" style="display: grid; grid-template-columns: 2fr 1fr; gap: 3rem; align-items: start;">

            <div class="cart-items-container">
                @php $grand_total = 0; @endphp

                @forelse($cartItems as $item)
                    <div class="cart-card"
                        style="display: flex; gap: 2rem; background: var(--white); padding: 2rem; border-radius: var(--radius); box-shadow: var(--box-shadow); margin-bottom: 2rem; align-items: center; border: var(--border);">

                        <div class="cart-img" style="width: 100px; height: 100px; flex-shrink: 0;">
                            <img src="{{ asset('uploaded_img/' . $item->product->image) }}" alt=""
                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                        </div>

                        <div class="cart-info" style="flex: 1;">
                            <h3 style="font-size: 1.8rem; margin-bottom: 0.5rem;">{{ $item->product->name }}</h3>
                            <p style="font-size: 1.4rem; color: var(--light-color);">Unit Price: Rp
                                {{ number_format($item->product->price, 0, ',', '.') }}</p>

                            <form action="{{ route('cart.update', $item->id) }}" method="post"
                                style="display: flex; gap: 1rem; align-items: center; margin-top: 1rem;">
                                @csrf
                                <input type="number" name="qty" class="modern-input" min="1" max="99"
                                    value="{{ $item->quantity }}" style="width: 70px; padding: 0.5rem; margin: 0;">
                                <button type="submit" class="fas fa-sync-alt"
                                    style="background: none; color: var(--main-color); font-size: 1.6rem; cursor: pointer;"></button>
                            </form>
                        </div>

                        <div class="cart-actions" style="text-align: right;">
                            <div class="sub-total" style="font-size: 1.8rem; font-weight: bold; margin-bottom: 1rem;">
                                Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                            </div>
                            <a href="{{ route('cart.delete', $item->id) }}" onclick="return confirm('Remove this item?');"
                                style="color: var(--red); font-size: 1.4rem; text-decoration: underline;">Remove</a>
                        </div>
                    </div>
                    @php $grand_total += ($item->product->price * $item->quantity); @endphp
                @empty
                    <div class="empty-state"
                        style="text-align: center; padding: 4rem; background: var(--white); border-radius: var(--radius);">
                        <p style="font-size: 1.8rem;">Your cart is empty.</p>
                        <a href="{{ url('/gallery') }}" class="btn" style="margin-top: 1rem;">Start Shopping</a>
                    </div>
                @endforelse
            </div>

            <div class="cart-summary"
                style="background: var(--white); padding: 3rem; border-radius: var(--radius); box-shadow: var(--box-shadow); border: var(--border); position: sticky; top: 10rem;">
                <h3 style="font-size: 2rem; margin-bottom: 2rem; border-bottom: 1px solid #eee; padding-bottom: 1rem;">Order
                    Summary</h3>

                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; font-size: 1.6rem;">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($grand_total, 0, ',', '.') }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 2rem; font-size: 1.6rem;">
                    <span>Tax</span>
                    <span>Rp 0</span>
                </div>
                <div
                    style="display: flex; justify-content: space-between; margin-bottom: 3rem; font-size: 2rem; font-weight: bold; color: var(--main-color);">
                    <span>Total</span>
                    <span>Rp {{ number_format($grand_total, 0, ',', '.') }}</span>
                </div>

                <a href="{{ url('/checkout') }}" class="btn"
                    style="width: 100%; text-align: center; margin-top: 0; {{ $grand_total > 0 ? '' : 'pointer-events: none; opacity: 0.5;' }}">
                    Checkout Now
                </a>

                @if ($grand_total > 0)
                    <a href="{{ route('cart.delete_all') }}" onclick="return confirm('Clear cart?');"
                        style="display: block; text-align: center; margin-top: 1.5rem; color: var(--light-color); font-size: 1.4rem;">
                        Clear Shopping Cart
                    </a>
                @endif
            </div>

        </div>
    </section>

@endsection
