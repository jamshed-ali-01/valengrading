<!DOCTYPE html>
<html>
<head>
    <title>Add Submission Type - Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, select, textarea { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        .btn { padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-primary { background: #007bff; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Add New Submission Type</h1>
    
    <form method="POST" action="{{ route('admin.submission-types.store') }}">
        @csrf
        
        <div class="form-group">
            <label for="name">Submission Type Name*</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="e.g., Grading, Reholder, Authentication" required>
            @error('name')<div class="error">{{ $message }}</div>@enderror
        </div>
        
        <div class="form-group">
            <label for="title">Display Title</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="e.g., Grading Service, Authentication Service">
            @error('title')<div class="error">{{ $message }}</div>@enderror
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="3">{{ old('description') }}</textarea>
            @error('description')<div class="error">{{ $message }}</div>@enderror
        </div>
        
        <div class="form-group">
            <label for="order">Display Order*</label>
            <input type="number" id="order" name="order" value="{{ old('order', 0) }}" required>
            @error('order')<div class="error">{{ $message }}</div>@enderror
        </div>
        
        <div class="form-group">
            <label for="is_active">Status*</label>
            <select id="is_active" name="is_active" required>
                <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('is_active', '1') == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('is_active')<div class="error">{{ $message }}</div>@enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Create Submission Type</button>
        <a href="{{ route('admin.submission-types.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>