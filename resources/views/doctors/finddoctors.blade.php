@extends('layout')

@section('title', 'Find Doctors')

@section('content')
<link rel="stylesheet" href="{{ url('css/uppform.css') }}">

<div class="navbar">
    <div class="navbar-brand">SKINGUARD</div>
    <div class="navbar-links">
        <form action="{{ route('doctors.finddoctors') }}" method="GET" class="doctor-sort-form">
            <select name="sort" onchange="this.form.submit()" class="sort-dropdown">
                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Sort by Name</option>
                <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Sort by Price</option>
                <option value="specialization" {{ request('sort') == 'specialization' ? 'selected' : '' }}>Sort by Specialization</option>
            </select>
            <input type="hidden" name="direction" value="{{ request('direction', 'asc') }}">
            <button type="submit" name="direction" value="{{ request('direction') == 'asc' ? 'desc' : 'asc' }}" class="sort-button">
                {{ request('direction') == 'asc' ? 'Descending' : 'Ascending' }}
             <a href="{{ route('doctors.findDoctorsByCity', request()->only(['sort', 'direction'])) }}" class="find-city-link">Find by City</a>

            </button>
        </form>

    </div>
</div>

<div class="container mt-4" style="position: relative; top: 120px;">
    <div class="row">
        @if ($doctors->isEmpty())
            <p class="text-center w-100">No doctors found.</p>
        @else
            <div class="row">
                @foreach ($doctors as $doctor)
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('doctors.show', $doctor->id) }}" class="text-decoration-none">
                            <div class="card shadow-sm">
                                <img style="width: 100%; height: 300px; object-fit: cover;" 
                                    src="{{ asset('uploads/doctors/' . $doctor->img) }}" 
                                    onerror="this.onerror=null; this.src='{{ asset('uploads/doctors/default-doctor.jpg') }}';" 
                                    class="card-img-top" 
                                    alt="Doctor Image">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $doctor->name }}</h5>
                                    <p class="card-text">Specialization: <strong>{{ $doctor->specialization }}</strong></p>
                                    <p class="card-text">City: <strong>{{ $doctor->city->namecity }}</strong></p>
                                    <p class="card-text">Price: <strong>${{ number_format($doctor->price, 2) }}</strong></p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                {{-- Previous Button --}}
                @if ($doctors->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $doctors->previousPageUrl() . '&' . http_build_query(request()->query()) }}" aria-label="Previous">
                            Previous
                        </a>
                    </li>
                @endif

                {{-- Pagination Numbers --}}
                @for ($page = 1; $page <= $doctors->lastPage(); $page++)
                    @if ($page == $doctors->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $doctors->url($page) . '&' . http_build_query(request()->query()) }}">{{ $page }}</a>
                        </li>
                    @endif
                @endfor

                {{-- Next Button --}}
                @if ($doctors->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $doctors->nextPageUrl() . '&' . http_build_query(request()->query()) }}" aria-label="Next">
                            Next
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">Next</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>
@endsection
