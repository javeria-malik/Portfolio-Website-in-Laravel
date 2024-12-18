<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education List</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Sidebar Style */
        #sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background: #343a40;
            color: white;
            padding-top: 20px;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            text-align: center;
        }

        #sidebar .sidebar-header .avatar {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        #sidebar .sidebar-header .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #sidebar .sidebar-header h1, #sidebar .sidebar-header p {
            margin: 0;
            color: white;
        }

        #sidebar ul {
            padding-left: 0;
        }

        #sidebar ul li {
            padding: 10px;
        }

        #sidebar ul li a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        #sidebar ul li a:hover {
            background-color: #495057;
        }

        /* Content Area */
        .content {
            margin-left: 250px;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .page-header {
            background-color: #343a40;
            color: white;
            padding: 10px;
            margin-bottom: 20px;
        }

        .page-header h1 {
            margin: 0;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-return {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn-return:hover {
            background-color: #218838;
        }

        .return-btn-container {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <nav id="sidebar">
        <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="admincss/img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
            <div class="title">
                <h1 class="h5">Javeria Malik</h1>
                <p>Laravel Developer</p>
            </div>
        </div>
        
        <ul class="list-unstyled">
            <li class="active"><a href="http://127.0.0.1:8000/"> <i class="icon-home"></i>Home </a></li>
            
            <li><a href="{{ route('educations.index') }}"> <i class="fa fa-bar-chart"></i>Educations</a></li>
            <li><a href="{{ route('experiences.index') }}"> <i class="fa fa-bar-chart"></i>Experiences</a></li>
            <li><a href="{{ route('services.index') }}"> <i class="fa fa-bar-chart"></i>Services</a></li>
            <li><a href="{{ route('skills.index') }}"> <i class="icon-padnote"></i>Skills</a></li>
            <li><a href="{{ route('projects.index') }}"> <i class="icon-layers"></i>Projects</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="content">
        <div class="page-header">
            <h1><center>Education List</center></h1>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('educations.create') }}" class="btn btn-primary">Add Education</a>
            

        <!-- Dropdown Filter -->
    <form method="GET" action="{{ route('educations.index') }}" class="form-inline">
        <label for="filter" class="mr-2" style="color: #007bff; font-weight: bold;">Filter Records:</label>
        <select name="filter" id="filter" class="form-control" onchange="this.form.submit()">
            <option value="without-trash" {{ $filter === 'without-trash' ? 'selected' : '' }}>Without Trash</option>
            <option value="with-trash" {{ $filter === 'with-trash' ? 'selected' : '' }}>With Trash</option>
        </select>
    </form>
        </div>

        @if(session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Degree</th>
                    <th>Institution</th>
                    <th>Start Year</th>
                    <th>End Year</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($educations as $education)
                    <tr>
                        <td>{{ $education->degree }}</td>
                        <td>{{ $education->institution }}</td>
                        <td>{{ $education->start_year }}</td>
                        <td>{{ $education->end_year }}</td>
                        <td>{{ $education->description }}</td>
                        <td>
                            @if($education->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                        @if ($filter === 'with-trash')
                            <!-- Show Restore and Delete buttons for trashed records -->
                            <form action="{{ route('educations.restore', $education->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                            </form>
                            <form action="{{ route('educations.force-delete', $education->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete Permanently</button>
                            </form>
                        @else
                            <!-- Normal actions for non-trashed records -->
                            <a href="{{ route('educations.edit', $education->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('educations.destroy', $education->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endif
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="return-btn-container">
            <a href="{{ url('/home') }}" class="btn-return">Return to Dashboard</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
