@extends('layout')

@section('title', $doctor->name)

@section('content')
<link rel="stylesheet" href="{{ url('css/uppform.css') }}">

<div class="navbar">
    <div class="navbar-brand">SKINGUARD</div>
    @if (Auth::user()->is_admin==1)
    <a href="{{route('doctors.generateSlots',$doctor->id)}}" class="btn btn-outline-success">Genrate Slots</a>

    @endif
    {{-- <div class="d-flex align-items-center" >
        <a href="{{ route('doctors.finddoctors') }}" class="text-decoration-none d-flex align-items-center">
            <h6 class="mb-0 me-2" style="color: black">Back</h6>
            <i class="fa-solid fa-angles-right" style="color: black"></i>
        </a>
    </div> --}}
    
    
</div>

<div class="container mt-5" style='position: relative; top : 100px;'>
    <div class="card shadow-lg">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('uploads/doctors/' . $doctor->img) }}" 
                     onerror="this.onerror=null; this.src='{{ asset('uploads/doctors/default-doctor.jpg') }}';" 
                     class="img-fluid rounded-start" 
                     alt="Doctor Image">
            </div>

            <div class="col-md-8">
                <div class="card-body">
                    <h2 class="card-title">{{ $doctor->name }}</h2>
                 
                        <p class="card-text">
                            <i class="fa-solid fa-stethoscope"></i>
                            <strong>Specialization:</strong> {{ $doctor->specialization }}
                        </p>
    
                        <p class="card-text">
                            <i class="fa-solid fa-location-dot text-danger"></i> 
                            <strong>City:</strong> {{ $doctor->city->namecity }}
                        </p>
    
                        <p class="card-text">
                            <i class="fa-solid fa-dollar-sign text-success"></i> 
                            <strong>Price:</strong> ${{ number_format($doctor->price, 2) }}
                        </p>
                        @if($doctor->slots->isNotEmpty())
                        <h3 class="mt-4">Available Slots</h3>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3"> 
                            @foreach($doctor->slots as $slot)
                                <div class="col">
                                    <div class="card h-100 shadow-sm border-0">
                                        <div class="card-body text-center">
                                            <h5 class="card-title text-primary">
                                                <i class="fa-solid fa-calendar-days"></i>
                                                {{ \Carbon\Carbon::parse($slot->date)->format('l, d M Y') }}
                                            </h5>
                    
                                            <p class="card-text text-muted">
                                                <i class="fa-solid fa-clock"></i>
                                                {{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }} - 
                                                {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}
                                            </p>
                    
                                            @if(!$slot->is_booked)
                                            <form action="{{route('slots.book',$slot->id)}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-success w-100">
                                                    <i class="fa-solid fa-check"></i> Book Now
                                                </button>
                                            </form>
                                            @else
                                                <span class="badge bg-danger p-2">Booked</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No available slots.</p>
                    @endif
                          </div>
            </div>
        </div>
    </div>
<p class="card-text">
    <strong>Rating:</strong>
    @for ($i = 1; $i <= 5; $i++)
        @if ($i <= round($doctor->averageRating()))
            <i class="fas fa-star text-warning"></i>  
        @else
            <i class="far fa-star text-muted"></i>  
        @endif
    @endfor
    ({{ number_format($doctor->averageRating(), 1) }} / 5)
</p>

{{-- @if(Auth::check()) 


    <form action="{{ route('Reviews.store') }}" method="POST">
        @csrf
        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

        <label for="rating" class="form-label"><strong>Rate this Doctor:</strong></label>
        <select name="Rating" id="rating" class="form-select" required>
            <option value="1">⭐ - Poor</option>
            <option value="2">⭐⭐ - Fair</option>
            <option value="3">⭐⭐⭐ - Good</option>
            <option value="4">⭐⭐⭐⭐ - Very Good</option>
            <option value="5">⭐⭐⭐⭐⭐ - Excellent</option>
        </select>

        <button type="submit" class="btn btn-primary mt-2">
            <i class="fa-solid fa-star"></i> Submit Rating
        </button>
    </form>
@endif --}}

</div>
@endsection
