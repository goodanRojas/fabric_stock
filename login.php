<?php

session_start();

include("conn.php");

if (isset($_POST["Login"])) {
    echo "Try to login";

    $EML = $_POST['Email'];
    $Pass = $_POST['Password'];
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    while ($data = mysqli_fetch_assoc($result)) {


        if ($data["email"] == $EML && $data["pwd"] == $Pass) {
            if ($data["type_of_user"] == 1) {
                $_SESSION["user_id"] = $data["id"];
                $fullname = $data["firstname"] . " " . $data["lastname"];
                $log_sql = "INSERT INTO user_logs (user_id, activities) VALUES ('{$data["user_id"]}', 'Logged in')";
                header("Location: dashboard.php");
                exit();
            } elseif ($data["type_of_user"] == 2) {
                $_SESSION["user_id"] = $data["id"];
                $fullname = $data["firstname"] . " " . $data["lastname"];
                $log_sql = "INSERT INTO user_logs (user_id, activities) VALUES ('{$data["user_id"]}', 'Logged in')";
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