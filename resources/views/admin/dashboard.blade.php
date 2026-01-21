<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>

<h1>Admin Dashboard</h1>

<p>Welcome, {{ auth()->user()->name }} (Admin)</p>

<form method="POST" action="{{ route('admin.logout') }}">
    @csrf
    <button type="submit">
        Logout
    </button>
</form>

</body>
</html>
