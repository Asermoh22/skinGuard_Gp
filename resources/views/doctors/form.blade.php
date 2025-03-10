@extends('layout')

@section('title')
Doctor - Form
@endsection



@section('content')
<link rel="stylesheet" href="{{ url('css/doctorform.css') }}">

<header class="navbar">
    <div class="navbar-brand">SKINGUARD</div>
    <nav class="navbar-links">
        <a href="{{route('main.main')}}" class="nav-link">Home</a>
  
     
    </nav>
</header>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
        <h1>{{$error}}</h1>
   @endforeach
    </ul>
@endif

<div class="container">
    <h1 class="form-header">Add Doctor</h1>
    <form action="{{ route('doctors.doctorhandel') }}" method="POST" enctype="multipart/form-data" >
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="city">Select City:</label>
            <select name="city_id" id="city" class="form-select" required>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->namecity }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">specialization</label>
            <input type="text" class="form-control" name="specialization" >
        </div>
        <div class="mb-3">
            <label class="form-label">Ticket Price</label>
            <input type="number" class="form-control" name="price" >
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Doctor Image</label>
            <input class="form-control" type="file" id="formFile" name="img" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection