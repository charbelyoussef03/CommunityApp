@extends('layout')

@section('content')
<div class="form-container">
    <h1>Register</h1>
    <form action="" method="POST">
        @csrf <!-- Laravel CSRF Token -->
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name" required>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
        </div>

        <button type="submit" class="btn-submit">Register</button>
    </form>
    <p class="login-link">
        Already have an account? <a href="{{ route('Login') }}">Login here</a>.
    </p>
</div>
@endsection
