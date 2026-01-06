@extends('layouts.app')
@section('title', 'Update Address')

@section('content')

    <section class="form-container">
        <form action="{{ route('address.update') }}" method="post">
            @csrf
            <h3>your address</h3>

            <input type="text" name="flat" placeholder="flat no. and building name" class="box"
                value="{{ Auth::user()->flat }}" required>
            <input type="text" name="street" placeholder="area name / street" class="box"
                value="{{ Auth::user()->street }}" required>
            <input type="text" name="city" placeholder="city name" class="box" value="{{ Auth::user()->city }}"
                required>
            <input type="text" name="state" placeholder="state name" class="box" value="{{ Auth::user()->state }}"
                required>
            <input type="text" name="country" placeholder="country name" class="box"
                value="{{ Auth::user()->country }}" required>
            <input type="number" name="pin_code" placeholder="pin code" class="box" value="{{ Auth::user()->pin_code }}"
                required>

            <input type="submit" value="save address" name="submit" class="btn">
        </form>
    </section>

@endsection
