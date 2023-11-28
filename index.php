

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="design/login.css">
    <title>Login</title>
</head>
<body>
    <form action="index.php" method="post"> <!-- Update the form action -->
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

<?php

session_start();

include("includes/config.php");

if (isset($_POST["Login"])) {
    echo "Try to login";

    $EML = $_POST['Email'];
    $Pass = $_POST['Password'];
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    while ($data = mysqli_fetch_assoc($result)) {


        if ($data["email"] == $EML && $data["pwd"] == $Pass) {
            if ($data["type_of_user"] == 1) {
                // Assuming $data["id"] contains the user ID
                $_SESSION["user_id"] = $data["id"];
                $fullname = $data["firstname"] . " " . $data["lastname"];

                // Use $_SESSION["user_id"] consistently
                $log_sql = "INSERT INTO user_log (user_id, activities) VALUES ('{$_SESSION["user_id"]}', 'Logged in')";

                header("Location: dashboard.php");
                exit();
            } elseif ($data["type_of_user"] == 2) {
                $_SESSION["user_id"] = $data["id"];
                $fullname = $data["firstname"] . " " . $data["lastname"];

                // Use $_SESSION["user_id"] consistently
                $log_sql = "INSERT INTO user_log (user_id, activities) VALUES ('{$_SESSION["user_id"]}', 'Logged in')";
                header("Location: udashboard.php");
                exit();
            }
        }
    }

    // If no matching user is found
    /*  echo "Invalid email or password";
     header("Location: index.php");
     exit(); */
}
?>
