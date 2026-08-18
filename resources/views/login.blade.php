@extends('layouts.app')
@section('title', 'Login - ArtTera')

@section('content')

    <section class="form-container">
        <form action="{{ route('login.post') }}" method="post">
            @csrf
            <h3>Login Now</h3>

            <label for="email" class="sr-only" style="display:none;">Email Address</label>
            <input type="email" id="email" name="email" required placeholder="enter your email…" maxlength="50" class="box" autocomplete="email" spellcheck="false">

            <label for="password" class="sr-only" style="display:none;">Password</label>
            <input type="password" id="password" name="password" required placeholder="enter your password…" maxlength="20" class="box" autocomplete="current-password">

            <button type="submit" class="btn" name="submit" style="width:100%;">Login Now</button>
            <p>Don't have an account? <a href="{{ url('/register') }}">Register now</a></p>
        </form>
    </section>

@endsection
