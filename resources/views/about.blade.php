@extends('layouts.app')
@section('title', 'Our Story')

@section('content')
    <section class="about-section">
        <div class="about-container">
            <div class="image">
                <img src="{{ asset('images/about-img-1.png') }}" alt="Our Story" width="500" height="500" class="about-img">
            </div>
            <div class="content">
                <h1 class="title">Redefining Digital Art</h1>
                <p>
                    ArtTera stands at the intersection of technology and creativity. Founded in 2026, we aim to provide a secure, transparent, and premium marketplace for artists and collectors worldwide.
                </p>

                <div class="stats">
                    <div class="stat-box">
                        <h3>5K+</h3>
                        <p>Artists</p>
                    </div>
                    <div class="stat-box">
                        <h3>12K+</h3>
                        <p>Artworks</p>
                    </div>
                </div>

                <a href="{{ url('/contact') }}" class="btn">Get in Touch</a>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .about-section { padding: 6rem 2rem; max-width: 1200px; margin: 0 auto; }
    .about-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 5rem; align-items: center; }
    .about-img { width: 100%; border-radius: 1.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
    .content p { font-size: 1.6rem; line-height: 1.8; color: var(--light-color); margin-bottom: 3rem; }
    .stats { display: flex; gap: 4rem; margin-bottom: 3rem; }
    .stat-box h3 { font-size: 3rem; color: var(--yellow); margin-bottom: 0.5rem; }
    .stat-box p { font-size: 1.4rem; color: var(--black); font-weight: 500; margin: 0; }
</style>
@endpush
