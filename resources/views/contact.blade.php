@extends('layouts.app')
@section('title', 'Contact Us')

@section('content')
    <section class="contact">
        <form action="" method="post">
            <h3>tell us something!</h3>
            <input type="text" name="name" placeholder="enter your name" required maxlength="20" class="box">
            <input type="email" name="email" placeholder="enter your email" required maxlength="50" class="box">
            <textarea name="msg" class="box" placeholder="enter your message" cols="30" rows="10"></textarea>
            <input type="submit" value="send message" name="send" class="btn">
        </form>
    </section>
@endsection
