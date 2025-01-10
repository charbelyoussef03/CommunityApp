@extends('layout')

@section('content')
<div class="profile-container">
    <h1>Profile</h1>
    <div class="user-details">
        <h2>Name</h2>
        <p><strong>Email:</strong>x.test.com </p>
        <p><strong>Joined:</strong> monday 12th 2025 </p>
    </div>

    <div class="user-content">
        <h3>Your Posts</h3>
            <ul>
                
                    <li>
                        <a href="">title</a>
                        <p>content</p>
                        <small>Posted on: xxxxxxxxxx</small>
                    </li>
            </ul>
    </div>

    <div class="user-activity">
        <h3>Your Activity</h3>
        <ul>
            <li><strong>Comments:</strong> 100 </li>
            <li><strong>Likes:</strong> 2000 </li>
            <li><strong>Upvotes:</strong> 5 </li>
        </ul>
    </div>
</div>
@endsection
