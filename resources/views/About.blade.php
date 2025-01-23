@extends('layout')

@section('content')
<div class="about-container">
    <div class="hero-section">
        <h1 class="about-title">About Us</h1>
        <p class="about-tagline">Discover our story, our values, and our vision for the future.</p>
    </div>
    
    <div class="content-section">
        <div class="about-card">
            <h2>Our Mission</h2>
            <p>
                At <strong>YourCompany</strong>, we aim to deliver excellence through innovation. 
                Our mission is to create meaningful experiences that make a difference in the lives of our customers.
            </p>
        </div>

        <div class="about-card">
            <h2>Our Values</h2>
            <ul class="values-list">
                <li><strong>Integrity:</strong> We believe in doing the right thing, always.</li>
                <li><strong>Innovation:</strong> Pushing boundaries to create exceptional solutions.</li>
                <li><strong>Customer Focus:</strong> Putting our customers at the heart of everything we do.</li>
            </ul>
        </div>

        <div class="about-card">
            <h2>Our Vision</h2>
            <p>
                To be the leaders in our industry, inspiring change and creating opportunities
                through cutting-edge technology and exceptional customer service.
            </p>
        </div>
    </div>
</div>
@endsection
