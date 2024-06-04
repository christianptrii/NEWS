<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfoZone</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

<div class="container">
    <div class="card">
        <h2>Login</h2>
        <h4>InfoZone</h4>
        <form action="login.php" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" placeholder="Username" name="username" required><br><br>
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Password" name="password" required><br><br>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</div>
</body>
</html>