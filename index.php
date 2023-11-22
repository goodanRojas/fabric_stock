

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="design/login.css">
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="post"> <!-- Update the form action -->
        <div class="Portal">
            
            <h1>Login</h1>
            
            <div class="input">
                <input type="email" placeholder="Email" name="Email" required>
            </div>
            
            <div class="input">
                <input type="password" placeholder="Password" name="Password" required>
            </div>

            <div class="submit">
                <input type="submit" value="Login" name="Login">
            </div>
            
            <div class="Register">
                <p>
                    Don't have an account yet? <a href="signup.php">Click here!</a>
                </p>
            </div>
        </div>
    </form>
</body>
</html>
