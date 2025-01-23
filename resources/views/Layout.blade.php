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
