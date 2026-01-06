@extends('layouts.app')
@section('title', 'Shopping Cart')

@section('content')

    <section class="shopping-cart">
        <h1 class="title">products added</h1>
        <div class="box-container">

            @php $grand_total = 0; @endphp

            @forelse($cartItems as $item)
                <form action="{{ route('cart.update', $item->id) }}" method="post" class="box">
                    @csrf

                    <a href="{{ route('cart.delete', $item->id) }}" class="fas fa-times"
                        onclick="return confirm('Hapus item ini?');"></a>

                    <a href="#" class="fas fa-eye"></a>

                    <img src="{{ asset('uploaded_img/' . $item->product->image) }}" alt="">

                    <div class="name">{{ $item->product->name }}</div>

                    <div class="flex">
                        <div class="price">Rp. {{ number_format($item->product->price, 0, ',', '.') }}</div>

                        <input type="number" name="qty" class="qty" min="1" max="99"
                            value="{{ $item->quantity }}" onchange="this.form.submit()">

                        <button type="submit" class="fas fa-edit"></button>
                    </div>

                    @php $sub_total = $item->product->price * $item->quantity; @endphp
                    <div class="sub-total"> sub total : <span>Rp. {{ number_format($sub_total, 0, ',', '.') }}</span> </div>
                </form>

                @php $grand_total += $sub_total; @endphp

            @empty
                <p class="empty">Keranjang belanja Anda kosong!</p>
            @endforelse

        </div>

        <div class="cart-total">
            <p>grand total : <span>Rp. {{ number_format($grand_total, 0, ',', '.') }}</span></p>
            <a href="{{ url('/gallery') }}" class="option-btn">continue shopping</a>

            <a href="{{ route('cart.delete_all') }}" class="delete-btn {{ $grand_total > 1 ? '' : 'disabled' }}"
                onclick="return confirm('Kosongkan keranjang?');">delete all</a>

            <a href="{{ url('/checkout') }}" class="btn {{ $grand_total > 1 ? '' : 'disabled' }}">proceed to checkout</a>
        </div>
    </section>

@endsection
