
<?php
include 'config.php';
session_start();

// Check if the form is submitted
if (isset($_POST['inserdata'])) {
    $user_type = $_POST['user_type'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $pass = $_POST['pass']; //apil nig edit
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
        $stmt = $conn->prepare("INSERT INTO users (type_of_user, firstname, lastname, email, contact, image_name, pwd) VALUES (?, ?,?, ?, ?, ?, ?)"); // apil sab ni by eloisa
        $stmt->bind_param("issssss", $user_type, $firstname, $lastname, $email, $contact, $image, $pass); // kani sab

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
