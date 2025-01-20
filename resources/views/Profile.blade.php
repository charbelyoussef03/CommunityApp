@extends('layout')

@section('content')
<div class="profile-container">
    <h1>Profile</h1>
    <div id="user-details">
        <p>Loading user details...</p>
    </div>
    <div id="posts-container">
        <p>Loading posts details...</p>
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
                <h2>${user.Name} ${user.LastName} </h2>
                <p><strong>Email:</strong> ${user.Email}</p>
                <p><strong>Date of Birth:</strong> ${user.DateOfBirth}</p>
                <p><strong>Joined:</strong> ${new Date(user.created_at).toLocaleDateString()}</p>
            `;
        })
        .catch(error => {
            console.error('Error fetching user details:', error);
            document.getElementById('user-details').innerHTML = `<p>Error loading user details. Please try again later.</p>`;
        });

        document.addEventListener('DOMContentLoaded', async function () {
        const token = localStorage.getItem('access_token'); // Retrieve the access token

        if (!token) {
            alert('You are not logged in!');
            window.location.href = "{{ route('Login') }}"; // Redirect to login page
            return;
        }

        try {
            const response = await fetch("/api/user/posts", {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();

            if (response.ok) {
                const postsContainer = document.getElementById('posts-container');

                // Populate the posts dynamically
                if (result.posts && result.posts.length > 0) {
                    result.posts.forEach(post => {
                        const postDiv = document.createElement('div');
                        postDiv.className = 'post';
                        postDiv.innerHTML = `
                            <h3>${post.Title}</h3>
                            <p>${post.Content}</p>
                            <small>Published on: ${new Date(post.created_at).toLocaleDateString()}</small>
                        `;
                        postsContainer.appendChild(postDiv);
                    });
                } else {
                    postsContainer.innerHTML = '<p>No posts found.</p>';
                }
            } else {
                alert('Failed to fetch posts. Please try again.');
            }
        } catch (error) {
            console.error('Error fetching posts:', error);
            alert('An error occurred. Please try again later.');
        }
    });
</script>
@endsection
