<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
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

        #sidebar .sidebar-header .avatar img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-bottom: 10px;
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

        .btn-return {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
        }

        .btn-return:hover {
            background-color: #218838;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .btn-sm {
            margin-left: 5px;
        }

        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <div class="avatar">
                <img src="admincss/img/avatar-6.jpg" alt="Avatar">
            </div>
            <h4>Javeria Malik</h4>
            <p>Laravel Developer</p>
        </div>
        <ul class="list-unstyled">
            <li><a href="http://127.0.0.1:8000/">Home</a></li>
            <li><a href="{{ route('educations.index') }}">Educations</a></li>
            <li><a href="{{ route('experiences.index') }}">Experiences</a></li>
            <li><a href="{{ route('services.index') }}">Services</a></li>
            <li><a href="{{ route('skills.index') }}"><i class="icon-padnote"></i> Skills</a></li>
            <li><a href="{{ route('projects.index') }}"><i class="icon-padnote"></i> Projects</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="content">
        <div class="page-header">
            <h1 class="text-center">Projects</h1>
        </div>

        <!-- Add Project Button -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('projects.create') }}" class="btn btn-primary">Add Project</a>
            

        <!-- Dropdown Filter -->
    <form method="GET" action="{{ route('projects.index') }}" class="form-inline">
        <label for="filter" class="mr-2" style="color: #007bff; font-weight: bold;">Filter Records:</label>
        <select name="filter" id="filter" class="form-control" onchange="this.form.submit()">
            <option value="without-trash" {{ $filter === 'without-trash' ? 'selected' : '' }}>Without Trash</option>
            <option value="with-trash" {{ $filter === 'with-trash' ? 'selected' : '' }}>With Trash</option>
        </select>
    </form>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->category }}</td>
                        <td><img src="{{ asset($project->image) }}" alt="{{ $project->title }}" style="width:100px;"></td>
                        <td>
                            @if($project->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                        @if ($filter === 'with-trash')
                            <!-- Show Restore and Delete buttons for trashed records -->
                            <form action="{{ route('projects.restore', $project->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                            </form>
                            <form action="{{ route('projects.force-delete', $project->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete Permanently</button>
                            </form>
                        @else
                            <!-- Normal actions for non-trashed records -->
                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline-block;">
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

        <!-- Return Button -->
        <div class="text-right">
            <a href="{{ url('/home') }}" class="btn-return">Return to Dashboard</a>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
