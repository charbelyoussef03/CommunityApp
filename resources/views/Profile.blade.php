@extends('layout')

@section('content')
<div class="profile-container">
    <h1>Profile</h1>
    <div id="user-details">
        <p>Loading user details...</p>
    </div>
</div>

<script>
    fetch('/api/user', {
        headers: {
            'Authorization': `Bearer ${localStorage.getItem('access_token')}`,
            'Accept': 'application/json'
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch user data. Please log in again.');
            }
            return response.json();
        })
        .then(user => {
            const userDetails = document.getElementById('user-details');
            userDetails.innerHTML = `
                <h2>${user.Name}</h2>
                <p><strong>Email:</strong> ${user.Email}</p>
                <p><strong>Joined:</strong> ${new Date(user.created_at).toLocaleDateString()}</p>
            `;
        })
        .catch(error => {
            console.error('Error fetching user details:', error);
            document.getElementById('user-details').innerHTML = `<p>Error loading user details. Please try again later.</p>`;
        });
</script>
@endsection
