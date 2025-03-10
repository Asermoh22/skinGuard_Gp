@extends('layout')

@section('title')
Register
@endsection

@section('content')

<link rel="stylesheet" href="{{ url('css/main.css') }}">

<nav class="navbar navbar-light" style="background-color : #cda678; height  : 80px; position : fixed; width : 100%; top : 0; z-index : 1000;">
    <div class="header">
        <h4 style="position : relative; top  : 4px; color : white;">SKINGUARD</h4>
    </div>
</nav>

<div class="form-container">
    <form action="{{ route('auth.handelregister') }}" method="post" class="form">
        @csrf
        <p class="title">Register</p>
        <p class="message">Signup now and get full access to our app.</p>

        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" 
                   class="form-control @error('name') is-invalid @enderror" 
                   placeholder="Enter your name" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   placeholder="Enter your email" value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" 
                   class="form-control @error('password') is-invalid @enderror" 
                   placeholder="Enter your password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="age" class="form-label">Age</label>
            <input type="number" name="age" id="age" min="0" 
                   class="form-control @error('age') is-invalid @enderror" 
                   placeholder="Enter your age" value="{{ old('age') }}">
            @error('age')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="city" class="form-label">Select City :</label>
            <select name="city" id="city" 
                    class="form-control @error('city') is-invalid @enderror">
                <option value="">Choose a city</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" {{ old('city') == $city->id ? 'selected'  : '' }}>
                        {{ $city->namecity }}
                    </option>
                @endforeach
            </select>
            @error('city')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="submit">Submit</button>
        <p class="signin text-center mt-3">Already have an account? 
            <a href="{{ route('auth.login') }}">Signin</a>
        </p>
    </form>
</div>

@endsection
