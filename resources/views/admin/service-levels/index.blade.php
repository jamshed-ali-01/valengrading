<!DOCTYPE html>
<html>
<head>
    <title>Service Levels - Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        .card { background: #f9f9f9; padding: 20px; margin-bottom: 20px; border-radius: 8px; }
        .btn { padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-primary { background: #007bff; color: white; }
        .btn-edit { background: #28a745; color: white; }
        .btn-delete { background: #dc3545; color: white; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        .active { color: green; }
        .inactive { color: red; }
        .alert { padding: 10px; margin-bottom: 20px; border-radius: 4px; }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-danger { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
<div class="container">
    <h1>Service Levels Management</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <a href="{{ route('admin.service-levels.create') }}" class="btn btn-primary">Add New Service Level</a>
    
    <table>
        <thead>
            <tr>
                <th>Order</th>
                <th>Name</th>
                <th>Delivery Time</th>
                <th>Min Cards</th>
                <th>Price/Card</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($serviceLevels as $level)
                <tr>
                    <td>{{ $level->order }}</td>
                    <td>{{ $level->name }}</td>
                    <td>{{ $level->delivery_time }}</td>
                    <td>
                        @if($level->min_submission)
                            {{ $level->min_submission }} cards
                        @else
                            No minimum
                        @endif
                    </td>
                    <td>€{{ number_format($level->price_per_card, 2) }}</td>
                    <td class="{{ $level->is_active ? 'active' : 'inactive' }}">
                        {{ $level->is_active ? 'Active' : 'Inactive' }}
                    </td>
                    <td>
                        <a href="{{ route('admin.service-levels.edit', $level) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('admin.service-levels.destroy', $level) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <br>
    <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
</div>
</body>
</html>