@extends('layouts.auth')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')
    <div class="container" id="page-one">
        <div class="inner-content">
            <div class="left-section">
                <form class="login-form" method="POST" action="{{ route('auth.authenticate') }}">
                    <a href="/"><i class="fa-solid fa-house"></i></a>
                    <h2>Login</h2>
                    @csrf
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>

                    <button type="submit">Login</button>

                    <div class="options">
                        <a href="{{ route('password.request') }}">Lupa Password?</a>

                        <a href="{{ route('signup') }}">Belum punya akun? Buat</a>
                    </div>
                </form>
            </div>

            <div class="right-section">
                <img src="{{ asset('asset/images/graphics/maskot-1.png') }}" alt="Login Image">
            </div>
        </div>
    </div>
@endsection