@extends('layouts.app')
@section('title', 'My Dashboard')

@section('content')

    {{-- DEFINISI VARIABLE AGAR VS CODE TIDAK ERROR --}}
    @php
        /** @var \App\Models\User $user */
        $user = Auth::user();
    @endphp

    <section class="profile-section" style="max-width: 800px; margin: 0 auto;">

        <div class="profile-header" style="text-align: center; margin-bottom: 4rem;">
            <div style="width: 120px; height: 120px; margin: 0 auto 2rem; border-radius: 50%; background: #f0f0f0; display: flex; align-items: center; justify-content: center; font-size: 4rem; color: var(--main-color);">
                <i class="fas fa-user"></i>
            </div>
            {{-- Gunakan $user, bukan Auth::user() --}}
            <h2 style="font-size: 3rem; margin-bottom: 0.5rem;">{{ $user->name }}</h2>
            <p style="font-size: 1.6rem; color: var(--light-color);">{{ $user->email }}</p>
        </div>

        <div class="profile-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">

            <div class="info-card" style="background: var(--white); padding: 3rem; border-radius: var(--radius); box-shadow: var(--box-shadow); border: var(--border);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h3 style="font-size: 2rem;">Personal Info</h3>
                    <a href="{{ route('profile.edit') }}" style="color: var(--main-color); font-size: 1.4rem;"><i class="fas fa-edit"></i> Edit</a>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="font-size: 1.3rem; color: var(--light-color); display: block;">Full Name</label>
                    <p style="font-size: 1.6rem;">{{ $user->name }}</p>
                </div>
                <div>
                    <label style="font-size: 1.3rem; color: var(--light-color); display: block;">Phone Number</label>
                    <p style="font-size: 1.6rem;">{{ $user->number ?? '-' }}</p>
                </div>
            </div>

            <div class="info-card" style="background: var(--white); padding: 3rem; border-radius: var(--radius); box-shadow: var(--box-shadow); border: var(--border);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h3 style="font-size: 2rem;">Shipping Address</h3>
                    <a href="{{ route('address.edit') }}" style="color: var(--main-color); font-size: 1.4rem;"><i class="fas fa-edit"></i> Edit</a>
                </div>

                @if($user->flat)
                    <p style="font-size: 1.6rem; line-height: 1.6;">
                        {{ $user->flat }}<br>
                        {{ $user->street }}<br>
                        {{ $user->city }}, {{ $user->state }}<br>
                        {{ $user->country }} - {{ $user->pin_code }}
                    </p>
                @else
                    <p style="font-size: 1.6rem; color: var(--light-color); font-style: italic;">No address saved.</p>
                @endif
            </div>

        </div>
    </section>

@endsection
