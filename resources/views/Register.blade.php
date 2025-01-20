@extends('GuestLayout')

@section('content')
<div class="form-container">
    <h1>Register</h1>
    <div id="errors" class="alert alert-danger" style="display: none;">
        <ul id="error-list"></ul>
    </div>
    <form id="register-form">
        <div class="form-group">
            <label for="Name">Name</label>
            <input type="text" id="name" name="Name" placeholder="Enter your full name" required>
        </div>

        <div class="form-group">
            <label for="LastName">Last Name</label>
            <input type="text" id="LastName" name="LastName" placeholder="Enter your last name" required>
        </div>

        <div class="form-group">
            <label for="Email">Email Address</label>
            <input type="email" id="Email" name="Email" placeholder="Enter your email" required>
        </div>

        <div class="form-group">
            <label for="PassWord">Password</label>
            <input type="password" id="PassWord" name="PassWord" placeholder="Enter your password" required>
        </div>

        <div class="form-group">
          <label for="DateOfBirth">Date of Birth</label>
          <input type="date" id="DateOfBirth" name="DateOfBirth" placeholder="Enter your date of birth" required>
       </div>



        <button type="button" class="btn-submit" id="submit-btn">Register</button>
    </form>
    <p class="login-link">
        Already have an account? <a href="{{ route('Login') }}">Login here</a>.
    </p>
</div>

<script>
    document.getElementById('submit-btn').addEventListener('click', async function () {
        const form = document.getElementById('register-form');
        const formData = new FormData(form);

        try {
            const response = await fetch("{{ route('api.register') }}", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json', // Expect JSON response
                },
                body: formData,
            });

            const result = await response.json();

            if (response.ok) {
                alert('Registration successful!');
                window.location.href = "{{ route('Login') }}";
                form.reset();
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
