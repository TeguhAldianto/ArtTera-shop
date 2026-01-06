@extends('layouts.app')
@section('title', 'About Us')

@section('content')
    <section class="about">
        <div class="row">
            <div class="box">
                <img src="{{ asset('images/about-img-1.png') }}" alt="">
                <h3>why choose us?</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                <a href="{{ url('/contact') }}" class="btn">contact us</a>
            </div>
        </div>
    </section>
@endsection
