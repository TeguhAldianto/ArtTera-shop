@extends('layouts.app')
@section('title', 'Register - ArtTera')

@section('content')

    <section class="form-container">
        <form action="{{ route('register.post') }}" method="post">
            @csrf
            <h3>Register Now</h3>

            <label for="name" class="sr-only" style="display:none;">Full Name</label>
            <input type="text" id="name" name="name" required placeholder="enter your name…" maxlength="50" class="box" autocomplete="name">

            <label for="email" class="sr-only" style="display:none;">Email Address</label>
            <input type="email" id="email" name="email" required placeholder="enter your email…" maxlength="50" class="box" autocomplete="email" spellcheck="false">

            <label for="password" class="sr-only" style="display:none;">Password</label>
            <input type="password" id="password" name="password" required placeholder="enter your password…" maxlength="20" class="box" autocomplete="new-password">

            <label for="password_confirmation" class="sr-only" style="display:none;">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="confirm your password…" maxlength="20" class="box" autocomplete="new-password">

            <button type="submit" class="btn" name="submit" style="width:100%;">Register Now</button>
            <p>Already have an account? <a href="{{ url('/login') }}">Login now</a></p>
        </form>
    </section>

@endsection
