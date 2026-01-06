@extends('layouts.app')
@section('title', 'Update Profile')

@section('content')

    <section class="form-container">
        <form action="{{ route('profile.update') }}" method="post">
            @csrf
            <h3>update profile</h3>

            <input type="text" name="name" placeholder="enter your name" class="box" value="{{ Auth::user()->name }}"
                required>
            <input type="email" name="email" placeholder="enter your email" class="box"
                value="{{ Auth::user()->email }}" required>
            <input type="number" name="number" placeholder="enter your number" class="box"
                value="{{ Auth::user()->number }}" required>

            <input type="password" name="old_pass" placeholder="enter your old password" class="box">
            <input type="password" name="new_pass" placeholder="enter your new password" class="box">
            <input type="password" name="confirm_pass" placeholder="confirm your new password" class="box">

            <input type="submit" value="update now" class="btn" name="submit">
        </form>
    </section>

@endsection
