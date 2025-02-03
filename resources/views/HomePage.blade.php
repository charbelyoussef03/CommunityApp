@extends('layout')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/search-style.css') }}">
@endsection

@section('content')

<div class="feed-wrapper">
    <h2 class="feed-title">Community Posts</h2>

    <!-- 🔍 Search and Filter Section -->
    <div class="search-bar-container">
        <div class="search-bar">
            <input type="text" id="searchPosts" class="search-input" placeholder="🔍 Search posts by title...">
            <div class="custom-dropdown">
                <select id="categoryFilter" class="filter-dropdown">
                    <option value="">All Categories</option>
                    <option value="Tech">Tech</option>
                    <option value="Health">Health</option>
                    <option value="Business">Business</option>
                </select>
            </div>
        </div>
    </div>

    <div id="feed-posts-list">
        <!-- Posts will be dynamically inserted here -->
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchPosts");
    const categoryFilter = document.getElementById("categoryFilter");

    searchInput.addEventListener("keyup", fetchFilteredPosts);
    categoryFilter.addEventListener("change", fetchFilteredPosts);

    fetchFilteredPosts(); // Load posts when the page loads

    async function fetchFilteredPosts() {
        const query = searchInput.value.trim();
        const category = categoryFilter.value;

        try {
            const response = await fetch(`/api/search?query=${query}&category=${category}`);
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
        const postsList = document.getElementById("feed-posts-list");
        postsList.innerHTML = "";

        posts.forEach(post => {
            const postDiv = document.createElement("div");
            postDiv.className = "feed-post";
            postDiv.innerHTML = `
                <div class="feed-post-header">
                    <span class="feed-post-title">${post.Title}</span>
                </div>
                <div class="feed-post-body">
                    <p class="feed-post-content">${post.Content}</p>
                </div>
                <div class="feed-post-actions">
                    <button class="feed-like-btn" data-id="${post.id}">
                        👍 Like (<span id="feed-like-count-${post.id}">${post.LikesCount}</span>)
                    </button>
                </div>
                <div class="feed-comments">
                    <h6 class="feed-comments-title">Comments</h6>
                    <ul class="feed-comments-list" id="feed-comments-list-${post.id}">
                        ${post.comments.length ? post.comments.map(comment => `
                            <li class="feed-comment-item">
                                <strong>${comment.person.Name}:</strong> ${comment.Content}
                            </li>
                        `).join('') : "<li class='no-comments'>No comments yet.</li>"}
                    </ul>
                    <div class="feed-comment-input-box">
                        <input id="feed-comment-input-${post.id}" type="text" placeholder="Write a comment..." class="feed-comment-input">
                        <button class="feed-comment-btn" data-id="${post.id}">Comment</button>
                    </div>
                </div>
            `;

            postDiv.querySelector(".feed-like-btn").addEventListener("click", () => likePost(post.id));
            postDiv.querySelector(".feed-comment-btn").addEventListener("click", () => addComment(post.id));

            postsList.appendChild(postDiv);
        });
    }

    async function likePost(postId) {
        const token = localStorage.getItem('access_token');

        try {
            const response = await fetch(`/api/like`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": `Bearer ${token}`,
                },
                body: JSON.stringify({ PostId: postId }),
            });

            const data = await response.json();

            if (data.success) {
                const likesElement = document.getElementById(`feed-like-count-${postId}`);
                likesElement.textContent = data.LikesCount;

                const likeButton = document.querySelector(`.feed-like-btn[data-id="${postId}"]`);
                likeButton.disabled = true;
                likeButton.classList.add("liked");
                likeButton.innerHTML = "✔ Liked";
            } else {
                alert(data.message);
            }
        } catch (error) {
            console.error("Error liking post:", error.message);
        }
    }

    async function addComment(postId) {
        const token = localStorage.getItem('access_token');
        const commentInput = document.getElementById(`feed-comment-input-${postId}`);
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
                    "Authorization": `Bearer ${token}`,
                },
                body: JSON.stringify({ PostId: postId, Content: commentText }),
            });

            const data = await response.json();

            if (data.success) {
                const commentsList = document.getElementById(`feed-comments-list-${postId}`);
                const newComment = document.createElement("li");
                newComment.className = "feed-comment-item";
                newComment.innerHTML = `<strong>You:</strong> ${commentText}`;
                commentsList.appendChild(newComment);
                commentInput.value = "";
            } else {
                alert(data.message);
            }
        } catch (error) {
            console.error("Error adding comment:", error.message);
        }
    }
});
</script>
@endsection
