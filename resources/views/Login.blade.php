@extends('layout')

@section('content')
<div class="form-container">
    <h1>Login</h1>
    <form action="" method="POST">
        @csrf <!-- Laravel CSRF Token -->
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <div class="form-group">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember Me</label>
        </div>

        <button type="submit" class="btn-submit">Login</button>
    </form>
    <p class="register-link">
        Don't have an account? <a href="{{ route('Register') }}">Register here</a>.
    </p>
</div>
@endsection
