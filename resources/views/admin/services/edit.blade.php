<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            margin: 0;
        }

        /* Sidebar Styling */
        #sidebar {
            width: 250px;
            background: #343a40;
            color: #fff;
            height: 100vh;
            position: fixed;
        }

        #sidebar .sidebar-header {
            text-align: center;
            padding: 20px 10px;
            border-bottom: 1px solid #495057;
        }

        #sidebar .sidebar-header .avatar img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        #sidebar .title h1 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        #sidebar .title p {
            font-size: 14px;
            color: #adb5bd;
        }

        #sidebar .heading {
            font-size: 18px;
            font-weight: bold;
            padding: 10px 15px;
            color: #adb5bd;
        }

        #sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #sidebar ul li {
            margin-bottom: 10px;
        }

        #sidebar ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            padding: 10px 15px;
            display: block;
            border-radius: 4px;
        }

        #sidebar ul li a:hover {
            background-color: #495057;
            color: #ffffff;
        }

        /* Main Content Styling */
        .content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .content h1 {
            font-size: 24px;
            color: #343a40;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <div class="avatar">
                <img src="admincss/img/avatar-6.jpg" alt="Profile Picture" class="img-fluid rounded-circle">
            </div>
            <div class="title">
                <h1 class="h5">Javeria Malik</h1>
                <p>Laravel Developer</p>
            </div>
        </div>
        <span class="heading">Main</span>
        <ul class="list-unstyled">
            <li><a href="http://127.0.0.1:8000/"><i class="icon-home"></i> Home</a></li>
            <li><a href="tables.html"><i class="icon-grid"></i> About Me</a></li>
            <li><a href="{{ route('educations.index') }}"><i class="fa fa-bar-chart"></i> Educations</a></li>
            <li><a href="{{ route('experiences.index') }}"><i class="icon-padnote"></i> Experiences</a></li>
            <li class="active"><a href="{{ route('services.index') }}"><i class="icon-padnote"></i> Services</a></li>
            <li><a href="{{ route('skills.index') }}"><i class="icon-padnote"></i> Skills</a></li>
            <li><a href="{{ route('projects.index') }}"><i class="icon-padnote"></i> Projects</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="content">
        <h1>Edit Service</h1>
        <form action="{{ route('services.update', $service->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <!-- Title -->
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $service->title) }}" required>
                @error('title')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4">{{ old('description', $service->description) }}</textarea>
                @error('description')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Icon Class -->
            <div class="form-group">
                <label for="icon_class">Icon Class (e.g., fa fa-flask)</label>
                <input type="text" id="icon_class" name="icon_class" value="{{ old('icon_class', $service->icon_class) }}">
                @error('icon_class')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>
            <div>
        <label for="is_active">Status</label>
        <select name="is_active" id="is_active">
            <option value="1" {{ $service->is_active ? 'selected' : '' }}>Active</option>
            <option value="0" {{ !$service->is_active ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>


            <button type="submit">Update</button>
        </form>
        <a href="{{ route('services.index') }}" class="back-link">Back to Services List</a>
    </div>
</body>
</html>
