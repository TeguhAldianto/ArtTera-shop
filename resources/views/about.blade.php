@extends('layouts.app')
@section('title', 'Our Story')

@section('content')
    <section class="about-section">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 5rem; align-items: center;">
            <div class="image">
                <img src="{{ asset('images/about-img-1.png') }}" alt="" style="width: 100%; border-radius: var(--radius); box-shadow: var(--box-shadow);">
            </div>
            <div class="content">
                <h1 class="title" style="text-align: left; margin-bottom: 2rem; margin-left: 0; transform: none; left: 0;">Redefining Digital Art</h1>
                <p style="font-size: 1.6rem; line-height: 2; color: var(--light-color); margin-bottom: 3rem;">
                    ArtTera stands at the intersection of technology and creativity. Founded in 2026, we aim to provide a secure, transparent, and premium marketplace for artists and collectors worldwide.
                </p>

                <div class="stats" style="display: flex; gap: 4rem; margin-bottom: 3rem;">
                    <div>
                        <h3 style="font-size: 3rem; color: var(--main-color);">5K+</h3>
                        <p style="font-size: 1.4rem;">Artists</p>
                    </div>
                    <div>
                        <h3 style="font-size: 3rem; color: var(--main-color);">12K+</h3>
                        <p style="font-size: 1.4rem;">Artworks</p>
                    </div>
                </div>

                <a href="{{ url('/contact') }}" class="btn">Get in Touch</a>
            </div>
        </div>
    </section>
@endsection
