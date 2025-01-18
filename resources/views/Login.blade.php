
@extends('GuestLayout')

@section('content')
<div class="form-container">
    <h1>Login</h1>
    <div id="errors" class="alert alert-danger" style="display: none;">
        <ul id="error-list"></ul>
    </div>
    <form id="login-form">
       @csrf
        <div class="form-group">
            <label for="Name">Name</label>
            <input type="name" id="Name" name="Name" placeholder="Enter your name" required>
       </div>
        
        <div class="form-group">
            <label for="Email">Email Address</label>
            <input type="email" id="Email" name="email" placeholder="Enter your email" required>
        </div>

        <div class="form-group">
            <label for="PassWord">Password</label>
            <input type="password" id="PassWord" name="password" placeholder="Enter your password" required>
        </div>

        <div class="form-group">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember Me</label>
        </div>

        <button type="button" class="btn-submit" id="submit-btn">Login</button>
    </form>
    <p class="register-link">
        Don't have an account? <a href="{{ route('Register') }}">Register here</a>.
    </p>
</div>

<script>
    document.getElementById('submit-btn').addEventListener('click', async function () {
        const form = document.getElementById('login-form');
        const formData = new FormData(form);

        // Transform the payload to match API expectations
        const payload = {
            Email: formData.get('email'),
            PassWord: formData.get('password')
        };

        try {
            const response = await fetch("{{ route('api.login') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json', // Specify JSON payload
                    'Accept': 'application/json', // Expect JSON response
                },
                body: JSON.stringify(payload), // Convert payload to JSON
            });

            const result = await response.json();
            console.log(result); 
            if (response.ok) {
                localStorage.setItem('access_token', result.access_token);
                alert('Login successful!');
                // Optionally, redirect to another page
                window.location.href = "{{ route('HomePage') }}"; // Update with the appropriate route
            } else {
                // Show validation errors
                const errorList = document.getElementById('error-list');
                errorList.innerHTML = '';
                result.errors && Object.values(result.errors).forEach(err => {
                    errorList.innerHTML += `<li>${err}</li>`;
                });
                document.getElementById('errors').style.display = 'block';
            }
        } catch (error) {
            console.error('Error submitting the form:', error);
            alert('An error occurred. Please try again later.');
        }
    });
</script>
@endsection
