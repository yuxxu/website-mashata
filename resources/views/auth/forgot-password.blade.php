@extends('layouts.auth')

@section('content')
    <div class="container" id="page-one">
        <div class="inner-content">
            <div class="left-section">
                <h2>Reset Password</h2>
                @if (session('status'))
                    <p>{{ session('status') }}</p>
                @endif
                <form class="login-form" action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <label for="email">Email:</label>
                    <input type="email" name="email" required>
                    <button type="submit">Kirim Link Reset</button>
                </form>
            </div>

            <div class="right-section">
                <img src="{{ asset('asset/images/graphics/maskot-1.png') }}" alt="Login Image">
            </div>
        </div>
    </div>
@endsection