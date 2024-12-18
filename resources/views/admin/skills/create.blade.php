<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Skill</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* General Styling */
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

        /* Active Link Styling */
        #sidebar ul li.active a {
            background-color: #007bff;
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

        input {
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

        .text-danger {
            color: red;
            font-size: 14px;
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
            <li><a href="{{ route('services.index') }}"><i class="icon-padnote"></i> Services</a></li>
            <li class="active"><a href="{{ route('skills.index') }}"><i class="icon-padnote"></i> Skills</a></li>
            <li><a href="{{ route('projects.index') }}"><i class="icon-padnote"></i> Projects</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="content">
        <h1>Add Skill</h1>
        <form action="{{ route('skills.store') }}" method="POST">
            @csrf
            <div>
                <label for="title">Skill Title:</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="percentage">Percentage:</label>
                <input type="number" id="percentage" name="percentage" value="{{ old('percentage') }}" required>
                @error('percentage')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div>
              <label for="is_active">Status:</label>
              <select id="is_active" name="is_active" required>
                 <option value="1" {{ $skill->is_active == 1 ? 'selected' : '' }}>Active</option>
                 <option value="0" {{ $skill->is_active == 0 ? 'selected' : '' }}>Inactive</option>
              </select>
            </div>

            <button type="submit">Save Skill</button>
        </form>
        <a href="{{ route('skills.index') }}" class="back-link">Back to Skills List</a>
    </div>
</body>
</html>
