@extends('layouts.app')
@section('title', 'Register - ArtTera')

@section('content')

    <section class="form-container">
        <form action="{{ route('register.post') }}" method="post">
            @csrf <h3>register now</h3>

            <input type="text" name="name" required placeholder="enter your name" maxlength="20" class="box">
            <input type="email" name="email" required placeholder="enter your email" maxlength="50" class="box">

            <input type="password" name="password" required placeholder="enter your password" maxlength="20" class="box">
            <input type="password" name="password_confirmation" required placeholder="confirm your password" maxlength="20"
                class="box">

            <input type="submit" value="register now" class="btn" name="submit">
            <p>already have an account? <a href="{{ url('/login') }}">login now</a></p>
        </form>
    </section>

@endsection
