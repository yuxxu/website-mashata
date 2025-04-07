@extends('layouts.auth')

@section('content')
<div class="container" id="page-one">
    <div class="inner-content">
        <div class="left-section">
            <h2>Reset Password</h2>
            <form class="login-form" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                    
                <label>Email:</label>
                <input type="email" name="email" required>
                    
                <label>Password Baru:</label>
                <input type="password" name="password" required>
                    
                <label>Konfirmasi Password:</label>
                <input type="password" name="password_confirmation" required>
                    
                <button type="submit">Reset Password</button>
            </form>    
        </div>
    </div>
</div>    
@endsection
