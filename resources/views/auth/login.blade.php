@extends('layout')

@section('title')
    Login
@endsection

@section('content')

<link rel="stylesheet" href="{{ url('css/home.css') }}">

<nav class="navbar navbar-light" style="background-color:#cda678; height : 80px; position: fixed; width : 100% ; top : 0; z-index: 1000;">
    <div class="header">
        <h4 style="position: relative; top : 4px;">SKINGUARD</h4>
    </div>
</nav>

@if ($errors->any())
<div class="background-shadow" id="backgroundShadow"></div> <!-- Background shadow overlay -->
<div class="alert alert-danger" id="errorAlert">
    <span class="close" onclick="closeAlert()">&times;</span>
    <strong>Error!</strong>
    <p>Please fix the following issues:</p>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<script>
function closeAlert() {
    document.getElementById('errorAlert').style.display = 'none'; 
    document.getElementById('backgroundShadow').style.display = 'none'; 
}
</script>

<div class="content">
    <form action="{{route('auth.handellogin')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <button class="submit">Submit</button>
        <p class="signin">You don't have an account? <a href="{{route('auth.register')}}">Signup</a></p>
        <a href="{{ route('user.redirectgoog') }}" class="btn-google w-100">
            <i class="fa-brands fa-google"></i> Sign Up With Google
        </a>
        
        </form>
</div>

@endsection