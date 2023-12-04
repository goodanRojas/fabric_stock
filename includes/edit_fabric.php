<?php
include("config.php");
session_start();
if (isset($_POST['insertdata'])) {
    $target = "../img/profile_image/" . basename($_FILES['image']['name']);

    $type = $_POST['type'];
    $color = $_POST['color'];
    $price = $_POST['price'];
    $caddr = $_POST['caddr'];
    $image = $_FILES['image']['name'];
    $id = $_POST['update_id'];


   
    $sql = "UPDATE fabric SET type = ?, color = ?, price = ?, current_stock_address = ?, image_name = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $type, $color, $price, $caddr, $image, $id); // corrected order

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

        ?>
        <script>
            alert("Deleted successfully");
            window.location.href = "../stock.php";
        </script>

        <?php

        header("Location: ../stock.php?updated=true");
        exit();
    } else {
        // Handle the case where the update failed
        header("Location: ../stock.php?error=Error updating user data");
        exit();
    }
}
?>