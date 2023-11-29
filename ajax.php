<?php
include("includes/config.php");

if (isset($_POST["update"])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $pass = $_POST['password'];
    $id = $_POST['id'];

    $sql = "UPDATE users SET firstname ='$firstname', lastname ='$lastname', email = '$email', contact = '$contact', pwd ='$pass' WHERE id = '$id' ";
    $result = mysqli_query($conn, $sql);
}
?>
