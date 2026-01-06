@extends('layouts.app')
@section('title', 'My Orders')

@section('content')

    <section class="orders">
        <h1 class="title">placed orders</h1>
        <div class="box-container">

            @forelse($orders as $order)
                <div class="box">
                    <p> placed on : <span>{{ $order->created_at->format('d-m-Y') }}</span> </p>
                    <p> name : <span>{{ $order->name }}</span> </p>
                    <p> email : <span>{{ $order->email }}</span> </p>
                    <p> address : <span>{{ $order->address }}</span> </p>
                    <p> payment method : <span>{{ $order->method }}</span> </p>

                    <p> your orders :
                        <span>
                            @foreach ($order->items as $item)
                                {{ $item->product->name }} ({{ $item->quantity }}) @if (!$loop->last)
                                    -
                                @endif
                            @endforeach
                        </span>
                    </p>

                    <p> total price : <span>Rp. {{ number_format($order->total_price, 0, ',', '.') }}/-</span> </p>
                    <p> payment status : <span
                            style="color:{{ $order->payment_status == 'pending' ? 'red' : 'green' }}">{{ $order->payment_status }}</span>
                    </p>
                </div>
            @empty
                <p class="empty">belum ada pesanan!</p>
            @endforelse

        </div>
    </section>

@endsection
