<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .menu { margin-top: 20px; }
        .menu a { display: block; padding: 12px 16px; margin: 8px 0; background: #f0f0f0; text-decoration: none; color: #333; border-radius: 6px; border-left: 4px solid #007bff; }
        .menu a:hover { background: #e0e0e0; border-left-color: #0056b3; }
        .logout-btn { padding: 8px 16px; background: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer; margin-top: 20px; }
        .logout-btn:hover { background: #c82333; }
    </style>
</head>
<body>

<h1>Admin Dashboard</h1>

<p>Welcome, <strong>{{ auth()->user()->name }}</strong> (Admin)</p>

<div class="menu">
    <a href="{{ route('admin.service-levels.index') }}">
        📊 <strong>Manage Service Levels</strong><br>
        <small>Add, edit or delete service levels (Standard, Express, Elite)</small>
    </a>
    
     <a href="{{ route('admin.label-types.index') }}">
        🏷️ <strong>Manage Label Types</strong><br>
        <small>Classic, Premium, Custom label types and pricing</small>
    </a>
   
</div>




<form method="POST" action="{{ route('admin.logout') }}" style="margin-top: 30px;">
    @csrf
    <button type="submit" class="logout-btn">
        🚪 Logout
    </button>
</form>

</body>
</html>