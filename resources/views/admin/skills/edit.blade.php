<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Skill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            line-height: 1.6;
        }
        h1 {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input, button, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        textarea {
            resize: vertical;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1em;
            padding: 10px 15px;
        }
        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        button:hover:enabled {
            background-color: #45a049;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007BFF;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .error {
            font-size: 0.9em;
            color: red;
        }
        .form-check {
            margin-top: 10px;
        }
        .form-check-input {
            margin-right: 10px;
            transform: scale(1.1); /* Slightly larger checkbox */
            cursor: pointer;
        }
        .form-check-label {
            display: inline-block;
            font-weight: normal;
            cursor: pointer;
        }
        .loading-spinner {
            display: none;
            margin-left: 10px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            width: 15px;
            height: 15px;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <h1>Edit Skill</h1>

    <form action="{{ route('skills.update', $skill->id) }}" method="POST" id="edit-skill-form">
        @csrf
        @method('PUT')

        <!-- Skill Title -->
        <div class="form-group">
            <label for="title">Skill Title <span class="error">*</span></label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                value="{{ old('title', $skill->title) }}" 
                aria-describedby="titleError" 
                required>
            @error('title')
                <span id="titleError" class="error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Percentage -->
        <div class="form-group">
            <label for="percentage">Proficiency Percentage <span class="error">*</span></label>
            <input 
                type="number" 
                id="percentage" 
                name="percentage" 
                value="{{ old('percentage', $skill->percentage) }}" 
                min="0" 
                max="100" 
                aria-describedby="percentageError" 
                required>
            @error('percentage')
                <span id="percentageError" class="error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description (Optional)</label>
            <textarea 
                id="description" 
                name="description" 
                rows="4" 
                aria-describedby="descriptionError">{{ old('description', $skill->description) }}</textarea>
            @error('description')
                <span id="descriptionError" class="error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Is Active Checkbox -->
        <div>
        <label for="is_active">Status</label>
        <select name="is_active" id="is_active">
            <option value="1" {{ $skill->is_active ? 'selected' : '' }}>Active</option>
            <option value="0" {{ !$skill->is_active ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

        <!-- Submit Button -->
        <button type="submit" id="submit-button">Update</button>
        <div class="loading-spinner" id="loading-spinner"></div>
    </form>

    <!-- Back Link -->
    <a href="{{ route('skills.index') }}" class="back-link">Back to Skills List</a>

    <script>
        const form = document.getElementById('edit-skill-form');
        const submitButton = document.getElementById('submit-button');
        const loadingSpinner = document.getElementById('loading-spinner');

        form.addEventListener('submit', function() {
            submitButton.disabled = true;
            loadingSpinner.style.display = 'inline-block';
        });
    </script>
</body>
</html>
