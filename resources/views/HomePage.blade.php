@extends('layout')

@section('content')
<div class="container">
    <h2>Posts</h2>
    <div id="posts-list">
        <!-- Posts will be loaded dynamically here -->
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    fetchPosts(); // Load posts when the page is ready
});

async function fetchPosts() {
    const accessToken = localStorage.getItem("access_token");

    try {
        const response = await fetch("{{ url('/api/posts') }}", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization": `Bearer ${accessToken}`
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();

        if (data.success) {
            renderPosts(data.posts);
        } else {
            console.error("Failed to fetch posts:", data.message);
        }
    } catch (error) {
        console.error("Error fetching posts:", error.message);
    }
}

function renderPosts(posts) {
    const postsList = document.getElementById("posts-list");
    postsList.innerHTML = ""; // Clear previous content

    posts.forEach(post => {
        const postDiv = document.createElement("div");
        postDiv.className = "post mb-4 p-3 border rounded";
        postDiv.id = `post-${post.id}`;

        postDiv.innerHTML = `
            <h4>${post.Title}</h4>
            <p>${post.Content}</p>
            <button class="like-btn btn btn-primary" data-id="${post.id}">
                👍 Like (<span id="likes-${post.id}">${post.LikesCount}</span>)
            </button>
            <h5>Comments:</h5>
            <ul id="comments-${post.id}">
                ${post.comments.length ? post.comments.map(comment => `
                    <li>${comment.Content} - <small>${comment.user ? comment.user.Name : "Anonymous"}</small></li>
                `).join('') : "<li>No comments yet.</li>"}
            </ul>
            <textarea id="comment-input-${post.id}" class="form-control mb-2" placeholder="Write a comment..."></textarea>
            <button class="comment-btn btn btn-secondary" data-id="${post.id}">Add Comment</button>
        `;

        // Add event listener for like button
        postDiv.querySelector(".like-btn").addEventListener("click", () => likePost(post.id));

        // Add event listener for add comment button
        postDiv.querySelector(".comment-btn").addEventListener("click", () => addComment(post.id));

        postsList.appendChild(postDiv);
    });
}



async function addComment(postId) {
    const accessToken = localStorage.getItem("access_token");
    const commentInput = document.getElementById(`comment-input-${postId}`);
    const commentText = commentInput.value.trim();

    if (!commentText) {
        alert("Comment cannot be empty.");
        return;
    }

    try {
        const response = await fetch(`/api/comment`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": `Bearer ${accessToken}`
            },
            body: JSON.stringify({
                PostId: postId, // Include PostId in the body
                Content: commentText
            })
        });

        const data = await response.json();

        if (data.success) {
            const commentsList = document.getElementById(`comments-${postId}`);
            const newComment = document.createElement("li");
            newComment.innerHTML = `${data.comment.Content} - <small>${data.comment.person.Name}</small>`;
            commentsList.appendChild(newComment);
            commentInput.value = ""; // Clear input after submission
        } else {
            alert("Failed to add comment.");
        }
    } catch (error) {
        console.error("Error adding comment:", error.message);
    }
}
async function likePost(postId) {
    const accessToken = localStorage.getItem("access_token");

    try {
        const response = await fetch("/api/like", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": `Bearer ${accessToken}`,
            },
            body: JSON.stringify({ PostId: postId }),
        });

        const data = await response.json();

        if (data.success) {
            // Update the likes count on the frontend
            const likesElement = document.getElementById(`likes-${postId}`);
            likesElement.textContent = data.LikesCount;

            // Disable the like button to prevent multiple clicks
            const likeButton = document.querySelector(`.like-btn[data-id="${postId}"]`);
            likeButton.disabled = true;
        } else {
            alert(data.message);
        }
    } catch (error) {
        console.error("Error liking post:", error.message);
    }
}



</script>
@endsection
