@extends('layouts.app')
@section('title', 'My Orders')

@section('content')

    <section class="orders-section" style="max-width: 900px; margin: 0 auto; padding: 4rem 2rem;">
        <h1 class="title" style="margin-bottom: 4rem;">Purchase History</h1>

        <div class="box-container" style="display: flex; flex-direction: column; gap: 2rem;">
            @forelse($orders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <span class="label">Order Date</span>
                            <div class="value">{{ $order->created_at->format('d M Y') }}</div>
                        </div>
                        <div class="status-badge {{ $order->payment_status }}">
                            {{ ucfirst($order->payment_status) }}
                        </div>
                    </div>

                    <div class="order-items">
                        @foreach ($order->items as $item)
                            <div class="item-row">
                                <span>{{ $item->product->name }} <span class="qty">x{{ $item->quantity }}</span></span>
                                <span class="price">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="order-footer">
                        <span>Total Amount</span>
                        <span class="total">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <p>You haven't placed any orders yet.</p>
                </div>
            @endforelse
        </div>
    </section>

@endsection

@push('styles')
<style>
    .order-card { background: var(--white); padding: 2.5rem; border-radius: 1.6rem; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.05); }
    .order-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid #f0f0f0; }
    .label { font-size: 1.2rem; color: var(--light-color); text-transform: uppercase; letter-spacing: 1px; }
    .value { font-size: 1.6rem; font-weight: 600; color: var(--black); }
    .status-badge { padding: 0.6rem 1.6rem; border-radius: 50px; font-size: 1.3rem; font-weight: 600; }
    .status-badge.pending { background: #fff3cd; color: #856404; }
    .status-badge.completed { background: #d4edda; color: #155724; }
    .item-row { display: flex; justify-content: space-between; margin-bottom: 0.8rem; font-size: 1.5rem; }
    .qty { color: var(--light-color); margin-left: 0.5rem; }
    .order-footer { display: flex; justify-content: space-between; align-items: center; background: #fcfcfc; padding: 1.5rem; margin-top: 2rem; border-radius: 1rem; }
    .total { font-size: 1.8rem; font-weight: 700; color: var(--yellow); }
</style>
@endpush
