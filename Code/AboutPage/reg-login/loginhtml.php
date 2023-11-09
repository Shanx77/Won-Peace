<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="reg.css">
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <form action="login.php" method="POST" id="login-form">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="http://localhost/Won-Peace-/Code/About%20Page/reg-login/reghtml.php">Register</a></p>  
    </div>

</body>
</html>
