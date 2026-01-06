@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
    {{-- DEFINISI VARIABLE AGAR VS CODE TIDAK ERROR --}}
    @php
        /** @var \App\Models\User $user */
        $user = Auth::user();
    @endphp

    <section class="checkout">
        <h1 class="title">order summary</h1>

        <form action="{{ route('order.place') }}" method="post">
            @csrf

            <div class="cart-items">
                <h3>cart items</h3>
                @php $grand_total = 0; @endphp
                @foreach ($cartItems as $item)
                    <p>
                        <span class="name">{{ $item->product->name }} (x{{ $item->quantity }})</span>
                        <span class="price">Rp.
                            {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>
                    </p>
                    @php $grand_total += ($item->product->price * $item->quantity); @endphp
                @endforeach
                <p class="grand-total"><span class="name">grand total :</span> <span class="price">Rp.
                        {{ number_format($grand_total, 0, ',', '.') }}</span></p>
                <a href="{{ url('/cart') }}" class="btn">view cart</a>
            </div>

            <div class="user-info">
                <h3>your info</h3>
                <div class="box-container" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">

                    {{-- Ganti Auth::user() jadi $user --}}
                    <input type="text" name="name" placeholder="your name" class="box" required
                        value="{{ $user->name }}">

                    <input type="number" name="number" placeholder="your number" class="box" required
                        value="{{ $user->number }}">

                    <input type="email" name="email" placeholder="your email" class="box" required
                        value="{{ $user->email }}">

                    <select name="method" class="box" required>
                        <option value="" disabled selected>select payment method</option>
                        <option value="cash on delivery">cash on delivery</option>
                        <option value="credit card">credit card</option>
                        <option value="paypal">paypal</option>
                    </select>
                </div>

                <h3>delivery address</h3>
                <div class="box-container" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    {{-- Ganti Auth::user() jadi $user --}}
                    <input type="text" name="flat" placeholder="flat no. & building" class="box" required
                        value="{{ $user->flat }}">

                    <input type="text" name="street" placeholder="street name" class="box" required
                        value="{{ $user->street }}">

                    <input type="text" name="city" placeholder="city" class="box" required
                        value="{{ $user->city }}">

                    <input type="text" name="state" placeholder="state" class="box" required
                        value="{{ $user->state }}">

                    <input type="text" name="country" placeholder="country" class="box" required
                        value="{{ $user->country }}">

                    <input type="number" name="pin_code" placeholder="pin code" class="box" required
                        value="{{ $user->pin_code }}">
                </div>
            </div>

            <input type="submit" value="place order" class="btn order-btn" name="order">
        </form>
    </section>

@endsection
