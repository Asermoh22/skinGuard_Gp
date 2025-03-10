@extends('layout')

@section('title')
Profile - {{$user->name}}
@endsection

@section('content')

<link rel="stylesheet" href="{{ url('css/profile.css') }}">
<!-- Navbar Section -->
{{-- <nav class="navbar">
    <div class="container">
        <a class="navbar-brand" href="#">SKINGUARD</a>
        <div class="navbar-links">
            <a class="nav-link" href="{{ url('/') }}">Home</a>
            <a class="nav-link" href="{{ url('/about') }}">About</a>
            <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
            <a href="{{ url('/profile') }}" class="nav-link">
                <i class="fas fa-user-circle" style="font-size: 20px; margin-left: 8px;"></i> {{$user->name}}
            </a>
        </div>
    </div>
</nav>

<!-- Main Content Section -->
<div class="main-content">
    <div class="container profile-container">
        <h1 class="profile-header">Profile Information</h1>
        <div class="profile-info">
            <div class="profile-item">
                <strong>Name:</strong>
                <span>{{$user->name}}</span>
            </div>
            <div class="profile-item">
                <strong>Email:</strong>
                <span>{{$user->email}}</span>
            </div>
            <div class="profile-item">
                <strong>Age:</strong>
                <span>{{$user->age}}</span>
            </div>
            <div class="profile-item">
                <strong>City:</strong>
                <span>{{$realcity->namecity}}</span>
            </div>
        </div>
        <footer>
            <p>© 2025 SKINGUARD. All rights reserved.</p>
        </footer>
    </div>
</div> --}}


<div class="navbar">
    <div class="navbar-brand">SKINGUARD</div>
    <div class="navbar-links">
        <a href="{{route('main.main')}}" class="nav-link">Home</a>
        {{-- <a href="/about" class="nav-link">About</a>
        <a href="/contact" class="nav-link">Contact</a> --}}
        <a href="" class="nav-link">
            <i class="fas fa-user-circle" style="font-size: 20px; margin-left: 8px;"></i> {{$user->name}}
        </a>
        </div>
</div>

<div class="main-content">
    <div class="container profile-container">
        <h1 class="profile-header">Profile Information</h1>
        <div class="profile-info">
            <div class="profile-item">
                <strong>Name:</strong> <span>{{$user->name}}</span>
            </div>
            <div class="profile-item">
                <strong>Email:</strong> <span>{{$user->email}}</span>
            </div>
            <div class="profile-item">
                <strong>Age:</strong> <span>{{$user->age}}</span>
            </div>
            <div class="profile-item">
                <strong>City:</strong> <span>{{$realcity->namecity}}</span>
            </div>
        </div>
        <footer>
            <p>© 2025 SKINGUARD. All rights reserved.</p>
        </footer>
    </div>
</div>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Your Bookings ({{ $user->bookings->count() }})</h2>

    @if($user->bookings->count() > 0)
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-7">
        @foreach($user->bookings as $booking)
                @if($booking->slot)
                    <div class="col">
                        <div class="card h-100 shadow-sm border rounded-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-start">
                                    <form action="{{ route('slots.cancelbook', $booking->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="fa-solid fa-times"></i>
                                        </button>
                                    </form>
                                </div>

                                <p class="card-title mt-2">
                                    <i class="fa-solid fa-user-md"></i> {{ $booking->slot->doctor->name }}
                                </p>
                                <p class="card-text mb-1">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <strong>Date:</strong> {{ \Carbon\Carbon::parse($booking->slot->date)->format('l, d M Y') }}
                                </p>
                                <p class="card-text mb-1">
                                    <i class="fa-solid fa-clock"></i>
                                    <strong>Time:</strong> {{ \Carbon\Carbon::parse($booking->slot->start_time)->format('h:i A') }} - 
                                    {{ \Carbon\Carbon::parse($booking->slot->end_time)->format('h:i A') }}
                                </p>
                                <span class="badge bg-success">Confirmed</span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="alert alert-warning text-center mt-4" role="alert">
            No bookings found.
        </div>
    @endif
</div>




@endsection
