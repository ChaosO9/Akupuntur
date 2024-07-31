<!-- resources/views/errors/401.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forbidden</title>
</head>

<body>
    <h1>Forbidden</h1>
    <p>You do not have permission to access this page.</p>
    <a href="{{ route('admin.login') }}">Log in as Admin here!</a>
</body>

</html>
