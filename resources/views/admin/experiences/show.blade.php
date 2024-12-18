<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Experience Details</title>
</head>
<body>
    <h1>Experience Details</h1>
    <p><strong>Title:</strong> {{ $experience->title }}</p>
    <p><strong>Company:</strong> {{ $experience->company }}</p>
    <p><strong>Position:</strong> {{ $experience->position }}</p>
    <p><strong>Description:</strong> {{ $experience->description }}</p>
    <p><strong>Start Date:</strong> {{ $experience->start_date }}</p>
    <p><strong>End Date:</strong> {{ $experience->end_date ?? 'Present' }}</p>
    <a href="/experiences">Back to List</a>
</body>
</html>
