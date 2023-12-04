<?php
include("config.php");
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    if (isset($_POST['deletedata'])) {
        $rowId = $_POST["delete_id"];

        $intValue = intval($rowId);




        // Delete user
        $sql = "DELETE FROM fabric WHERE id = $intValue";
        $result = mysqli_query($conn, $sql);

        ?>
        <script>
            alert("Deleted successfully");
            window.location.href = "../stock.php";
        </script>

        <?php
        header("../stock.php");
        exit();


        // ...

    }
}
?>