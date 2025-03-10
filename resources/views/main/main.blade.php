@extends('layout')

@section('title')
Main
@endsection

@section('content')

<link rel="stylesheet" href="{{ url('css/homeepage.css') }}">
<nav class="navbar">
    <div class="container">
        <a class="navbar-brand">SKINGUARD</a>
        <div class="navbar-links">
            @if (Auth::user()->is_admin==0)
        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    <a class="nav-link" href="{{ url('/about') }}">About</a>
                    <a class="nav-link" href="{{ url('/contact') }}">Contact</a>


            @endif
           
            @if (Auth::user()->is_admin==1)
            <a class="nav-link" href="{{ url('/') }}">Home</a>
            <a class="nav-link" href="{{route('doctors.form') }}">Doctors</a>
            <a class="nav-link" href="{{route('dashboard.main')}}">Dashboard</a>
            @endif
            <a href="{{route('profile.profile')}}" class="nav-link">
                <i class="fas fa-user-circle" style="font-size: 20px; margin-left : 8px;"></i> Profile
            </a>
            <a href="{{ route('auth.logout') }}" class="btn btn-danger">Logout</a>
        </div>
    </div>
</nav>

<div class="hero-section">
    <div class="hero-content">
             <h1>Detect Skin Diseases Accurately with AI-Powered Technology</h1>
        <p>Upload an image of your skin condition and get instant, reliable results using our advanced deep learning model.</p>
        <a href="{{route('main.tomodel')}}" class="cta-button">Get Started Now</a>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <h5>Skin AI</h5>
            <p>Your reliable partner in detecting skin diseases with AI technology.</p>
        </div>
        <div class="footer-links">
            <h5>Links</h5>
            <ul>
                <li><a href="{{ url('/') }}">Privacy Policy</a></li>
                <li><a href="{{ url('/about') }}">Terms of Service</a></li>
                <li><a href="{{ url('/contact') }}">Contact Us</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2025 Skin AI. All rights reserved.</p>
    </div>
</footer>
@endsection