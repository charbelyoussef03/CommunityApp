<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Sharely</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background-color: #f4f4f9;
            color: #333;
        }
        /* Navigation Bar */
        nav {
            background: #2a2a72;
            color: #fff;
            padding: 10px 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        nav .brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        nav .hamburger {
            display: none;
            cursor: pointer;
            flex-direction: column;
            gap: 5px;
        }

        nav .hamburger span {
            background: #fff;
            height: 3px;
            width: 25px;
            border-radius: 5px;
            transition: 0.3s;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        nav ul li {
            margin: 0;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #4c4cff;
            color: #e0e0ff;
        }

        /* Responsive Menu */
        @media (max-width: 768px) {
            nav .hamburger {
                display: flex;
            }

            nav ul {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
                background: #2a2a72;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                padding: 10px 0;
                text-align: center;
            }

            nav ul.active {
                display: flex;
            }

            nav ul li a {
                padding: 10px 0;
            }
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Grid Layout for Home Page */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .grid-item {
            background: #f9f9ff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .grid-item h3 {
            margin: 0 0 10px;
        }
        .form-container {
        max-width: 600px;
        margin: 20px auto;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-container h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #2a2a72;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #2a2a72;
        outline: none;
        box-shadow: 0 0 5px rgba(42, 42, 114, 0.2);
    }

    .btn-submit {
        display: block;
        width: 100%;
        background: #2a2a72;
        color: #fff;
        border: none;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
        background: #4c4cff;
    }
        /* Footer */
        footer {
            background: #2a2a72;
            color: #fff;
            padding: 20px;
            text-align: center;
            margin-top: 20px;
        }

        footer a {
            color: #e0e0ff;
            text-decoration: none;
            margin: 0 10px;
            font-weight: 500;
        }

        footer a:hover {
            text-decoration: underline;
        }
        .grid .home-btn{
            padding: 10px 12px;
            cursor : pointer;
            background: #2a2a72;
            color: #fff;
            font-size : 16px;
            border-radius : 5px
        }
        .profile-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .user-details {
        margin-bottom: 20px;
    }

    .user-details h2 {
        margin: 0 0 10px;
    }

    .user-content,
    .user-activity {
        margin-bottom: 20px;
    }

    .user-content ul {
        list-style: none;
        padding: 0;
    }

    .user-content li {
        border-bottom: 1px solid #ddd;
        padding: 10px 0;
    }

    .user-content li:last-child {
        border-bottom: none;
    }

    .user-content li a {
        font-weight: bold;
        color: #2a2a72;
        text-decoration: none;
    }

    .user-content li a:hover {
        text-decoration: underline;
    }

    .user-activity ul {
        list-style: none;
        padding: 0;
    }

    .user-activity li {
        margin-bottom: 10px;
    }

    /* about */
    .about-container {
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
    color: #333;
    padding: 2rem;
    background-color: #f9f9f9;
}

.hero-section {
    text-align: center;
    background: linear-gradient(135deg,#2a2a72,rgba(62, 142, 65, 0.43));
    color: #fff;
    padding: 2rem 1rem;
    margin-bottom: 2rem;
    border-radius: 10px;
}

.about-title {
    font-size: 3rem;
    font-weight: bold;
    margin-bottom: 1rem;
}

.about-tagline {
    font-size: 1.5rem;
    font-weight: 300;
}

.content-section {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.about-card {
    background: #fff;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.about-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.about-card h2 {
    font-size: 1.8rem;
    color: #2a2a72;
    margin-bottom: 0.5rem;
}

.values-list {
    list-style: none;
    padding: 0;
}

.values-list li {
    margin-bottom: 0.8rem;
    padding-left: 1.5rem;
    position: relative;
}

.values-list li::before {
    content: '✔';
    color: #4CAF50;
    position: absolute;
    left: 0;
    top: 0;
}
/*profile styles */
 /* Overall Profile Container */
 .profile-container {
        margin: 20px auto;
        max-width: 800px;
        padding: 20px;
        background: #f7f9fc;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Header */
    .profile-container h1 {
        text-align: center;
        font-size: 2rem;
        color: #333;
        margin-bottom: 20px;
    }

    /* User Details Container */
    .user-details-container,
    .posts-container {
        margin-top: 20px;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background: #fff;
        color: #333;
        font-family: 'Arial', sans-serif;
    }

    .user-details-container p,
    .posts-container p {
        font-size: 1rem;
        color: #666;
    }

    /* Post Styling */
    .post {
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        background: #f9f9f9;
    }

    .post h3 {
        margin: 0 0 10px 0;
        font-size: 1.2rem;
        color: #2a2a72;
    }

    .post p {
        margin: 0 0 10px 0;
        font-size: 0.95rem;
        color: #444;
    }

    .post small {
        font-size: 0.85rem;
        color: #999;
    }

    /* Loading State */
    #user-details p,
    #posts-container p {
        text-align: center;
        font-style: italic;
        animation: fade 1.5s infinite;
    }

    /* Fade animation for loading state */
    @keyframes fade {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }

/* homepage */
/* General Styles */
/* General Styles */
body {
 
}

/* Feed Container */
.feed-wrapper {
    max-width: 600px !important;
    width: 100% !important;
    margin: 20px auto !important;
    padding: 10px !important;
}
.feed-title{
   text-align : center;
}
/* Post Card */
.feed-post {
    background: #fff !important;
    border-radius: 12px !important;
    padding: 16px !important;
    margin-bottom: 20px !important;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1) !important;
    transition: box-shadow 0.3s ease-in-out !important;
}

.feed-post:hover {
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15) !important;
}

/* Post Header */
.feed-post-header {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    padding-bottom: 8px !important;
    border-bottom: 1px solid #ddd !important;
}

.feed-post-title {
    font-size: 16px !important;
    font-weight: bold !important;
    color: #333 !important;
}

/* Post Content */
.feed-post-content {
    font-size: 15px !important;
    color: #555 !important;
    margin-top: 10px !important;
    line-height: 1.5 !important;
}

/* Post Actions */
.feed-post-actions {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    margin-top: 10px !important;
    border-top: 1px solid #eee !important;
    padding-top: 8px !important;
}

/* Like Button */
.feed-like-btn {
    display: flex !important;
    align-items: center !important;
    gap: 5px !important;
    background: none !important;
    border: none !important;
    font-weight: bold !important;
    color: #1877f2 !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    padding: 6px 12px !important;
    border-radius: 5px !important;
}

.feed-like-btn:hover {
    background: rgba(24, 119, 242, 0.1) !important;
}

.feed-like-btn.liked {
    color: #ff3e4d !important;
    pointer-events: none !important;
}

/* Comments Section */
.feed-comments {
    margin-top: 15px !important;
    padding-top: 10px !important;
}

.feed-comments-title {
    font-weight: bold !important;
    font-size: 14px !important;
    margin-bottom: 6px !important;
}

.feed-comments-list {
    list-style-type: none !important;
    padding: 0 !important;
    max-height: 180px !important;
    overflow-y: auto !important;
}

/* Comment Item */
.feed-comment-item {
    padding: 8px 12px !important;
    border-radius: 8px !important;
    background: #f5f5f5 !important;
    margin-bottom: 6px !important;
    font-size: 14px !important;
    transition: 0.3s ease !important;
}

.feed-comment-item:hover {
    background: #e9ecef !important;
}

/* Comment Input */
.feed-comment-input-box {
    display: flex !important;
    gap: 8px !important;
    margin-top: 10px !important;
}

.feed-comment-input {
    flex: 1 !important;
    padding: 10px !important;
    border: 1px solid #ddd !important;
    border-radius: 20px !important;
    font-size: 14px !important;
    transition: all 0.3s ease !important;
}

.feed-comment-input:focus {
    border-color: #1877f2 !important;
}

/* Comment Button */
.feed-comment-btn {
    background: #2a2a72 !important;
    color: white !important;
    border: none !important;
    padding: 8px 12px !important;
    border-radius: 20px !important;
    cursor: pointer !important;
    font-weight: bold !important;
    transition: background 0.3s ease-in-out !important;
}

.feed-comment-btn:hover {
    background: #36992b !important;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .feed-wrapper {
        max-width: 100% !important;
        padding: 10px !important;
    }
}

/* 🔍 Search Bar Wrapper */
.search-bar-container {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

/* Search Bar Box */
.search-bar {
    display: flex;
    background: white;
    border-radius: 30px;
    padding: 5px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease-in-out;
    width: 500px;
    max-width: 100%;
}

/* 🔎 Search Input */
.search-input {
    flex: 1;
    padding: 12px 15px;
    border: none;
    font-size: 16px;
    border-radius: 30px 0 0 30px;
    outline: none;
    transition: all 0.3s ease;
}

.search-input::placeholder {
    color: #aaa;
}

/* 📂 Category Filter */
.search-filter {
    background: #f8f9fa;
    border: none;
    padding: 12px;
    font-size: 16px;
    border-radius: 0 30px 30px 0;
    cursor: pointer;
    outline: none;
    transition: all 0.3s ease-in-out;
}

/* 🖱️ Hover & Focus Effects */
.search-input:focus {
    background: #f0f2f5;
}

.search-filter:hover {
    background: #e2e6ea;
}

/* 📱 Responsive Design */
@media (max-width: 768px) {
    .search-bar {
        width: 100%;
    }
}

    /* 📂 Category Filter Dropdown */
.custom-dropdown {
    position: relative;
    display: flex;
    align-items: center;
    background: #f8f9fa;
    border-radius: 0 30px 30px 0;
    padding: 0 15px;
    transition: all 0.3s ease-in-out;
}

/* Styled Select */
.filter-dropdown {
    appearance: none;
    border: none;
    background: transparent;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    padding: 12px 30px 12px 10px;
    outline: none;
    color: #333;
}

/* Custom Dropdown Arrow */
.custom-dropdown::after {
    content: "▼";
    font-size: 12px;
    position: absolute;
    right: 12px;
    color: #777;
    pointer-events: none;
}

/* Hover Effects */
.custom-dropdown:hover {
    background: #e2e6ea;
}

.filter-dropdown:focus {
    outline: none;
    box-shadow: 0 0 5px rgba(24, 119, 242, 0.3);
}

/* 📱 Responsive Design */
@media (max-width: 768px) {
    .search-bar {
        width: 100%;
    }
}







/* ✅ General Improvements */
:root {
    --primary-color: #007bff;
    --success-color: #28a745;
    --danger-color: #dc3545;
    --text-color: #333;
    --border-radius: 8px;
    --transition-speed: 0.3s ease-in-out;
}

/* 🔹 Post Actions (Edit & Delete Buttons) */
.post-actions {
    display: flex;
    gap: 8px;
    margin-top: 12px;
}

/* 🔹 Edit Form Container */
.edit-form-container {
    display: none;
    margin-top: 12px;
    padding: 12px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: var(--border-radius);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    width: 100%;
    transition: var(--transition-speed);
}

/* 🔹 Input Fields */
.edit-input {
    width: 95%;
    padding: 10px;
    margin-bottom: 12px;
    border: 1px solid #ddd;
    border-radius: var(--border-radius);
    font-size: 15px;
    background-color: #f8f9fa;
    color: var(--text-color);
    transition: var(--transition-speed);
}

.edit-input:focus {
    outline: none;
    border-color: var(--primary-color);
    background-color: #fff;
    box-shadow: 0 0 6px rgba(0, 123, 255, 0.3);
}

/* 🔹 Buttons (Edit, Save, Cancel, Delete) */
.action-btn {
    padding: 8px 14px;
    font-size: 14px;
    font-weight: 600;
    border-radius: var(--border-radius);
    cursor: pointer;
    border: none;
    transition: var(--transition-speed);
}

/* ✅ Edit Button */
.edit-btn {
    background-color: var(--primary-color);
    color: white;
}

.edit-btn:hover {
    background-color: #0056b3;
}

/* ✅ Save Button */
.save-btn {
    background-color: var(--success-color);
    color: white;
}

.save-btn:hover {
    background-color: #218838;
}

/* ✅ Cancel Button */
.cancel-btn {
    background-color: var(--danger-color);
    color: white;
}

.cancel-btn:hover {
    background-color: #c82333;
}

/* ✅ Delete Button */
.delete-btn {
    background-color: #ff4d4f;
    color: white;
}

.delete-btn:hover {
    background-color: #d9363e;
}


    </style>
</head>
<body>
    <nav>
        <div class="brand">Sharely`</div>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <ul>
            <li><a href="{{ route('HomePage') }}">Home</a></li>
            <li><a href="{{ route('Profile') }}">Profile</a></li>
            <li><a href="{{ route('CreatePost') }}">Create Post</a></li>
            <li><a href="{{ route('About') }}">About</a></li>
            <li><a href="{{ route('Contact') }}">Contact</a></li>
        </ul>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <footer>
        <p>&copy; 2025 Sharely. All Rights Reserved.</p>
        <a href="{{ route('About') }}">About</a> |
        <a href="{{ route('Contact') }}">Contact</a>
    </footer>

    <script>
        // Hamburger Menu Toggle
        const hamburger = document.querySelector('.hamburger');
        const navMenu = document.querySelector('nav ul');

        hamburger.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });
    </script>
</body>
</html>
