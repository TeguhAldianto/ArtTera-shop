@extends('layouts.app')
@section('title', 'Login - ArtTera')

@section('content')

    <section class="form-container">
        <form action="{{ route('login.post') }}" method="post">
            @csrf <h3>login now</h3>

            <input type="email" name="email" required placeholder="enter your email" maxlength="50" class="box">
            <input type="password" name="password" required placeholder="enter your password" maxlength="20" class="box">

            <input type="submit" value="login now" class="btn" name="submit">
            <p>don't have an account? <a href="{{ url('/register') }}">register now</a></p>
        </form>
    </section>

@endsection
