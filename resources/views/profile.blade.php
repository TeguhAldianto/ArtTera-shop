@extends('layouts.app')
@section('title', 'My Profile')

@section('content')

    <section class="user-details">
        <div class="user">
            <img src="{{ asset('images/user-icon.png') }}" alt="">
            <p><i class="fas fa-user"></i> <span>{{ Auth::user()->name }}</span></p>
            <p><i class="fas fa-phone"></i> <span>{{ Auth::user()->number ?? 'Belum diatur' }}</span></p>
            <p><i class="fas fa-envelope"></i> <span>{{ Auth::user()->email }}</span></p>

            <a href="{{ route('profile.edit') }}" class="btn">update profile</a>

            <p class="address">
                <i class="fas fa-map-marker-alt"></i>
                <span>
                    @if (Auth::user()->flat)
                        {{ Auth::user()->flat }}, {{ Auth::user()->street }}, {{ Auth::user()->city }} -
                        {{ Auth::user()->pin_code }}
                    @else
                        Alamat belum diatur
                    @endif
                </span>
            </p>
            <a href="{{ route('address.edit') }}" class="btn">update address</a>
        </div>
    </section>

@endsection
