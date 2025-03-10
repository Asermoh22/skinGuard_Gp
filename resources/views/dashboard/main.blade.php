@extends('layout')

@section('title', 'Dashboard')

@section('content')
<link rel="stylesheet" href="{{ url('css/dashboard.css') }}">


<div class="dashboard-wrapper">
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>SKINGUARD</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="#" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="#"><i class="fas fa-users"></i> Manage Users</a></li>
            <li><a href="#"><i class="fas fa-user-md"></i> Manage Doctors</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
            <li><a href="#" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>

        <!-- Data Tabs inside Sidebar -->
        <div class="data-tabs">
            <button class="tablink" onclick="showData('users')" id="defaultTab">Users</button>
            <button class="tablink" onclick="showData('doctors')">Doctors</button>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <header class="dashboard-header">
            <h2>Dashboard</h2>
            <div class="user-info">
                <span>Welcome, {{ Auth::user()->name }}</span>
            </div>
        </header>

        <!-- Cards Section -->
        <div class="cards">
            <div class="card bg-primary">
                <div class="card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h5>Total Users</h5>
                <h3>{{ $users->count() }}</h3>
            </div>
            <div class="card bg-warning">
                <div class="card-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h5>Admins</h5>
                <h3>{{ $users->where('is_admin', 1)->count() }}</h3>
            </div>
            <div class="card bg-success">
                <div class="card-icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <h5>Total Doctors</h5>
                <h3>{{ $doctors->count() }}</h3>
            </div>
        </div>

        <!-- Users Section -->
        <div id="users" class="data-section">
            <div class="table-header">
                <h4>Users List</h4>
                <button class="btn-add-user"><i class="fas fa-plus"></i> Add User</button>
            </div>
            <div class="table-responsive">
                <table class="table-users">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="role-badge {{ $user->is_admin ? 'admin' : 'user' }}">
                                    {{ $user->is_admin ? 'Admin' : 'User' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <form action="{{ route('admin.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                
                                                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Doctors Section -->
        <div id="doctors" class="data-section" style="display:none;">
            <div class="table-header">
                <h4>Doctors List</h4>
                <button class="btn-add-doctor"><i class="fas fa-plus"></i> Add Doctor</button>
            </div>
            <div class="table-responsive">
                <table class="table-doctors">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Specialization</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctors as $doctor)
                        <tr>
                            <td>{{ $doctor->id }}</td>
                            <td>{{ $doctor->name }}</td>
                            <td>{{ $doctor->price }}</td>
                            <td>{{ $doctor->specialization }}</td>
                            <td>{{ $doctor->city->namecity }}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <form action="{{ route('admin.delete', $doctor->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</div>

<script>
function showData(section) {
    document.getElementById('users').style.display = section === 'users' ? 'block' : 'none';
    document.getElementById('doctors').style.display = section === 'doctors' ? 'block' : 'none';
}

// Set default tab to Users on load
document.getElementById("defaultTab").click();
</script>
@endsection
