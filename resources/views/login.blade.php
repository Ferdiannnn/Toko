<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{!! asset('assets/css/login.css') !!}">
    <title>Login Page</title>
</head>

<body>
    <div class="login-container">
        <form class="login-form" action="" method="post">
            @csrf
            <h1>Login</h1>
            <label for="email">email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>
