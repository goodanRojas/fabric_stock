<?php
include("config.php");
session_start();
if (isset($_POST['user_id'])) {
    $target = "../img/profile_image/" . basename($_FILES['image']['name']);

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $pass = $_POST['pass'];
    $usertype = $_POST['user_type']; // corrected variable name
    $id = $_POST['user_id']; // corrected variable name
    $image = $_FILES['image']['name'];

    // Check if any required field is empty
    if (empty($firstname) || empty($lastname) || empty($email) || empty($contact) || empty($image) || empty($pass) || empty($usertype) || empty($id)) {
        // Handle the case where a required field is empty
        header("Location: ../user.php?error=Please fill out all fields");
        exit();
    }

    // Update user data
    $sql = "UPDATE users SET image_name = ?, firstname = ?, lastname = ?, email = ?, contact = ?, pwd = ?, type_of_user = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $image, $firstname, $lastname, $email, $contact, $pass, $usertype, $id); // corrected order

    if ($stmt->execute()) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);

        $user_id = $_SESSION['user_id'];
        $log_sql = "INSERT INTO user_log (user_id, activities) VALUES(?, 'Updated a row')";
        $log_stmt = $conn->prepare($log_sql);
        $log_stmt->bind_param("i", $user_id);
        $log_stmt->execute();

        $stmt->close();
        $log_stmt->close();
        $conn->close();

        header("Location: ../user.php?updated=true");
        exit();
    } else {
        // Handle the case where the update failed
        header("Location: ../user.php?error=Error updating user data");
        exit();
    }
}
?>