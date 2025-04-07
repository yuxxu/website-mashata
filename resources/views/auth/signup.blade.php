@extends('layouts.auth')

@section('content')
    <div class="container" id="page-signup">
        <div class="inner-content">
            <div class="left-section">
                <form class="signup-form" method="POST" action="{{ route('register') }}">
                    @csrf

                    <a href="/"><i class="fa-solid fa-house"></i></a>
                    <h2>Sign Up</h2>
                    
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" class="input" placeholder="Enter your full name" required>
                    
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="input" placeholder="Enter your email" required>
                    
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="input" placeholder="Enter your password" required>
                    
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="input" placeholder="Confirm your password" required>
                    
                    <button type="submit">Sign Up</button>
                    
                    <div class="options">
                        <a href="{{ route('login') }}">Sudah punya akun? Login</a>
                    </div>
                </form>
            </div>
            
            <div class="right-section">
                <img src="{{ asset('asset/images/graphics/maskot-2.png') }}" alt="Sign Up Image">
            </div>
        </div>
    </div>
@endsection
