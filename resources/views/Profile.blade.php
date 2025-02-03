@extends('layout')

@section('content')
<div class="profile-container">
    <h1>Profile</h1>
    <div id="user-details" class="user-details-container">
        <p>Loading user details...</p>
    </div>
    <div id="posts-container" class="posts-container">
        <p>Loading posts...</p>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", async function () {
    const token = localStorage.getItem('access_token');

    if (!token) {
        alert('You are not logged in!');
        window.location.href = "{{ route('Login') }}";
        return;
    }

    try {
        // 🔹 Fetch User Details
        const userResponse = await fetch('/api/user', {
            headers: { 'Authorization': `Bearer ${token}`, 'Accept': 'application/json' }
        });
        const user = await userResponse.json();

        document.getElementById('user-details').innerHTML = `
            <h2>Welcome ${user.Name} ${user.LastName}</h2>
            <p><strong>Email:</strong> ${user.Email}</p>
            <p><strong>Date of Birth:</strong> ${user.DateOfBirth}</p>
            <p><strong>Joined:</strong> ${new Date(user.created_at).toLocaleDateString()}</p>
        `;

        // 🔹 Fetch User Posts
        const postsResponse = await fetch("/api/user/posts", {
            method: 'GET',
            headers: { 'Authorization': `Bearer ${token}`, 'Accept': 'application/json' }
        });

        const result = await postsResponse.json();
        const postsContainer = document.getElementById('posts-container');

        if (result.posts && result.posts.length > 0) {
            postsContainer.innerHTML = '';
            result.posts.forEach(post => {
                const postDiv = document.createElement('div');
                postDiv.className = 'post';
                postDiv.innerHTML = `
                    <h3>${post.Title}</h3>
                    <p>${post.Content}</p>
                    <small>Published on: ${new Date(post.created_at).toLocaleDateString()}</small>
                    <div class="post-actions">
                        <button class="edit-btn" onclick="editPost(${post.id})">✏️ Edit</button>
                        <button class="delete-btn" onclick="deletePost(${post.id})">🗑 Delete</button>
                    </div>
                    <div id="edit-form-${post.id}" class="edit-form-container" style="display:none;">
                        <label>Title:</label>
                        <input type="text" id="edit-title-${post.id}" class="edit-input" value="${post.Title}">
                        <label>Content:</label>
                        <textarea id="edit-content-${post.id}" class="edit-input">${post.Content}</textarea>
                        <div class="edit-actions">
                            <button onclick="savePost(${post.id})" class="save-btn">💾 Save</button>
                            <button onclick="cancelEdit(${post.id})" class="cancel-btn">❌ Cancel</button>
                        </div>
                    </div>
                `;
                postsContainer.appendChild(postDiv);
            });
        } else {
            postsContainer.innerHTML = '<p>No posts found.</p>';
        }
    } catch (error) {
        console.error('Error fetching data:', error);
        alert('An error occurred. Please try again later.');
    }
});

// 🔹 Show Edit Form
function editPost(postId) {
    document.getElementById(`edit-form-${postId}`).style.display = "block";
}

// 🔹 Cancel Edit
function cancelEdit(postId) {
    document.getElementById(`edit-form-${postId}`).style.display = "none";
}

// 🔹 Save Edited Post
async function savePost(postId) {
    const token = localStorage.getItem('access_token');
    const newTitle = document.getElementById(`edit-title-${postId}`).value;
    const newContent = document.getElementById(`edit-content-${postId}`).value;

    try {
        const response = await fetch(`/api/posts/${postId}`, {  // ✅ Corrected API URL
            method: 'PUT',
            headers: { 
                'Authorization': `Bearer ${token}`, 
                'Content-Type': 'application/json' 
            },
            body: JSON.stringify({ Title: newTitle, Content: newContent })
        });

        const result = await response.json();
        console.log("Server response:", result); // ✅ Debugging

        if (result.success) {
            alert('Post updated successfully!');
            window.location.reload();
        } else {
            alert(`Failed to update post: ${result.message}`);
        }
    } catch (error) {
        console.error('Error updating post:', error);
        alert('An error occurred. Please try again.');
    }
}

// 🔹 Delete Post
async function deletePost(postId) {
    const token = localStorage.getItem('access_token');

    if (!confirm(`Are you sure you want to delete this post?`)) return;

    try {
        const response = await fetch(`/api/posts/${postId}`, {
            method: 'DELETE',
            headers: { 'Authorization': `Bearer ${token}` }
        });

        const result = await response.json();
        console.log("Server response:", result);

        if (result.success) {
            alert('Post deleted successfully!');
            window.location.reload();
        } else {
            alert(`Failed to delete post: ${result.message}`);
        }
    } catch (error) {
        console.error('Error deleting post:', error);
        alert('An error occurred. Please try again.');
    }
}
</script>
@endsection
