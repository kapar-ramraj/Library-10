<!DOCTYPE html>
<html>

<head>
    <title>User Credentials</title>
</head>

<body>
    <h2>Hello, {{$name}}</h2>
    <p>Your account has been created. Here are your login credentials:</p>

    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Password:</strong> {{ $password }}</p>

    <p>Please change your password after logging in for the first time.</p>

    <br>
    <p>Regards,<br>Library Mgmt</p>
</body>

</html>
