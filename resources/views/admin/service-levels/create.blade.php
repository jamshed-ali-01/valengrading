<!DOCTYPE html>
<html>
<head>
    <title>Add Service Level - Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, select, textarea { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        .btn { padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-primary { background: #007bff; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        .checkbox { width: auto; }
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Add New Service Level</h1>
    
    <form method="POST" action="{{ route('admin.service-levels.store') }}">
        @csrf
        
        <div class="form-group">
            <label for="name">Service Level Name*</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')<div class="error">{{ $message }}</div>@enderror
        </div>
        
        <div class="form-group">
            <label for="delivery_time">Delivery Time*</label>
            <input type="text" id="delivery_time" name="delivery_time" value="{{ old('delivery_time') }}" placeholder="e.g., 15-20 Business Days" required>
            @error('delivery_time')<div class="error">{{ $message }}</div>@enderror
        </div>
        
        <div class="form-group">
            <label for="min_submission">Minimum Cards Required</label>
            <input type="number" id="min_submission" name="min_submission" value="{{ old('min_submission') }}" min="0" placeholder="Leave empty for no minimum">
            <small>Enter 0 or leave empty if no minimum cards required</small>
            @error('min_submission')<div class="error">{{ $message }}</div>@enderror
        </div>
        
        <div class="form-group">
            <label for="price_per_card">Price Per Card (€)*</label>
            <input type="number" step="0.01" min="0" id="price_per_card" name="price_per_card" value="{{ old('price_per_card') }}" required>
            @error('price_per_card')<div class="error">{{ $message }}</div>@enderror
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
        
        <button type="submit" class="btn btn-primary">Create Service Level</button>
        <a href="{{ route('admin.service-levels.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>