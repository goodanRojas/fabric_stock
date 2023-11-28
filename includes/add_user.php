<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <style>
        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        .btn {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .back {
            display: flex;
            width: 200px;
            height: 50px;
            background-color: rgb(174, 148, 217);
            justify-content: center;
            align-items: center;
            border-radius: 25px;
        }

        a {
            display: block;
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <p class="error">
        <?php
        // Check if 'error_message' key exists in $_SESSION array before echoing
        echo isset($_SESSION['error_message']) ? htmlspecialchars($_SESSION['error_message']) : '';
        ?>
    </p>

    <form action="add_user.php" method="post" enctype="multipart/form-data">
        <label for="user_type">User Type</label>
        <input type="radio" name="user_type" value="1" required>Admin
        <input type="radio" name="user_type" value="2" required>User
        <label for="firstname">Firstname</label>
        <input type="text" id="firstname" name="firstname" required placeholder="Enter Firstname">
        
        <label for="lastname">Lastname</label>
        <input type="text" id="lastname" name="lastname" required placeholder="Enter Lastname">

        <label for="email">Email</label>
        <input type="text" id="email" name="email" required placeholder="Enter Email">

        <label for="contact">Contact</label>
        <input type="text" id="contact" name="contact" required placeholder="Enter Contact">

         <!-- added password input (eloisa) -->
         <label for="Password">Password</label>
    <input type="text" id="Password" name="password"> 

        <label for="image">Image</label>
        <input type="file" id="image" name="image" required>

       

       
        <button type="submit" name="upload">Add</button>
    </form>

    <div class="back">
        <a href="../user.php">Back to the Use Page</a>
    </div>
</body>
</html>

<?php
include 'config.php';
session_start();

// Check if the form is submitted
if (isset($_POST['upload'])) {
    $user_type = $_POST['user_type'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $pass = $_POST['password'];// gidugangan
    $contact = $_POST['contact'];

    $image = $_FILES['image']['name'];
    $target = "../img/profile_image/" . basename($_FILES['image']['name']);
    $tmp_location = $_FILES['image']['tmp_name'];

    $user_id = $_SESSION['user_id'];

    // Check for duplicate email
    $check_email_sql = "SELECT COUNT(*) as count FROM users WHERE email = ?";
    $stmt_check_email = $conn->prepare($check_email_sql);
    $stmt_check_email->bind_param("s", $email);
    $stmt_check_email->execute();
    $result_check_email = $stmt_check_email->get_result();
    $row = $result_check_email->fetch_assoc();

    if ($row['count'] > 0) {
        // Duplicate email found
        $_SESSION['error_message'] = "Email is already in use";
        header("Location: add_user.php");
        exit(); // Make sure to exit after a header redirect
    }

    // File upload handling
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        // Insert the file path into the database using prepared statement
        $stmt = $conn->prepare("INSERT INTO users (type_of_user, firstname, lastname, email, contact, image_name, pwd) VALUES (?, ?, ?, ?, ?, ?,?)"); // gidugangan ug pwd
        $stmt->bind_param("issssss", $user_type, $firstname, $lastname, $email, $contact, $image, $pass); //gidugang ang pass ug gibutangan ug s means string

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id; // Assuming user_id is an auto-incrementing primary key

            // Insert user log using prepared statement
            $log_stmt = $conn->prepare("INSERT INTO user_log (user_id, activities) VALUES (?, 'Added a row')");
            $log_stmt->bind_param("i", $user_id);

            if ($log_stmt->execute()) {
                // Both inserts successful
                echo "User added successfully.";
                header("Location: ../user.php");
                exit(); // Make sure to exit after a header redirect
            } else {
                // Insert into user_log failed
                echo "Error adding user log: " . $conn->error;
            }
        } else {
            // Insert into users failed
            echo "Error adding user: " . $conn->error;
        }

        $stmt->close();
        $log_stmt->close();
    } else {
        // File upload failed
        echo "Error uploading file.";
    }

    $stmt_check_email->close();
}

// Clear the error message once displayed
unset($_SESSION['error_message']);
?>
