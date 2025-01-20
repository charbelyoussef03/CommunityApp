@extends('layout')

@section('content')
<div class="form-container">
    <h1>Create Post</h1>
    <form id="createPostForm" method="POST">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="Title" placeholder="Enter the title" required>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea id="content" name="Content" rows="6" placeholder="Enter the content" required></textarea>
        </div>

        <div class="form-group">
            <label for="tags">Category</label>
            <input type="text" id="tags" name="Category" placeholder="Enter tags (comma-separated)" required>
        </div>

        <div class="form-group">
            <label for="pictureUrl">Picture URL</label>
            <input type="url" id="pictureUrl" name="PictureUrl" placeholder="Enter a valid picture URL" required>
        </div>

        <button type="submit" class="btn-submit">Submit</button>
    </form>
    <div id="responseMessage" class="response-message"></div>
</div>
@endsection
<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('createPostForm');
    const responseMessage = document.getElementById('responseMessage');

    form.addEventListener('submit', async (event) => {
        event.preventDefault(); 

        const postData = {
            Title: document.getElementById('title').value,
            Content: document.getElementById('content').value,
            Category: document.getElementById('tags').value,
            PictureUrl: document.getElementById('pictureUrl').value,
        };

        const token = localStorage.getItem('access_token'); 

        try {
            const response = await fetch('{{ route("posts.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`, 
                },
                body: JSON.stringify(postData),
            });

            if (response.ok) {
                const data = await response.json();
                responseMessage.textContent = 'Post created successfully!';
                responseMessage.style.color = 'green'; // Success styling
                form.reset(); // Clear the form
                console.log('Created post:', data);
            } else {
                const errorData = await response.json();
                responseMessage.textContent = 'Error: ' + (errorData.message || 'Unable to create post.');
                responseMessage.style.color = 'red'; // Error styling
                console.error('Error response:', errorData);
            }
        } catch (error) {
            responseMessage.textContent = 'An unexpected error occurred.';
            responseMessage.style.color = 'red'; // Error styling
            console.error('Error:', error);
        }
    });
});

</script>