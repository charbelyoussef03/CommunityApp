@extends('layout')

@section('content')
<div class="form-container">
    <h1>Create Post</h1>
    <form action="" method="POST">
        @csrf <!-- Laravel CSRF Token -->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Enter the title" required>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea id="content" name="content" rows="6" placeholder="Enter the content" required></textarea>
        </div>

        <div class="form-group">
            <label for="tags">Tags</label>
            <input type="text" id="tags" name="tags" placeholder="Enter tags (comma-separated)">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" placeholder="Enter a brief description"></textarea>
        </div>

        <button type="submit" class="btn-submit">Submit</button>
    </form>
</div>
@endsection
