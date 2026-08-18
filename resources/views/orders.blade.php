@extends('layouts.app')
@section('title', 'My Orders')

@section('content')

    <section class="orders-section">
        <h1 class="title">Purchase History</h1>

        <div class="box-container">
            @forelse($orders as $order)
                <div class="order-card"
                    style="background: var(--white); padding: 2.5rem; border-radius: var(--radius); box-shadow: var(--box-shadow); border: var(--border); position: relative; overflow: hidden;">

                    <div
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid #eee;">
                        <div>
                            <span style="font-size: 1.4rem; color: var(--light-color);">Order Date</span>
                            <div style="font-size: 1.6rem; font-weight: bold;">{{ $order->created_at->format('d M Y') }}
                            </div>
                        </div>
                        <div class="status-badge"
                            style="padding: 0.5rem 1.5rem; border-radius: 50px; font-size: 1.4rem; font-weight: 500;
                            background: {{ $order->payment_status == 'pending' ? '#fff3cd' : '#d4edda' }};
                            color: {{ $order->payment_status == 'pending' ? '#856404' : '#155724' }};">
                            {{ ucfirst($order->payment_status) }}
                        </div>
                    </div>

                    <div class="order-items" style="margin-bottom: 2rem;">
                        @foreach ($order->items as $item)
                            <div
                                style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; font-size: 1.5rem;">
                                <span>{{ $item->product->name }} <span
                                        style="color: var(--light-color);">x{{ $item->quantity }}</span></span>
                            </div>
                        @endforeach
                    </div>

                    <div
                        style="display: flex; justify-content: space-between; align-items: center; background: #f8f9fa; padding: 1.5rem; margin: 0 -2.5rem -2.5rem; border-top: 1px solid #eee;">
                        <span style="font-size: 1.5rem;">Total Amount</span>
                        <span style="font-size: 1.8rem; font-weight: bold; color: var(--main-color);">Rp
                            {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            @empty
                <div class="empty-state" style="grid-column: 1/-1; text-align: center; padding: 4rem;">
                    <p style="font-size: 1.8rem; color: var(--light-color);">You haven't placed any orders yet.</p>
                </div>
            @endforelse
        </div>
    </section>

@endsection
