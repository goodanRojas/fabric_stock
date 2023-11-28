<?php 
include("config.php"); // Make sure to include the semicolon at the end
session_start();
// Pwede ra gamiton ning nga code e dynamic laman ang row column og table name parhihas pag gamit sa id
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
        
    if (isset($_POST['delete_row'])) {
        
        // Get the row ID to be deleted
        $rowId = intval($_POST["id"]);
        
        $user_id = $_SESSION['user_id'];
        // SQL query to delete the row
        $tableName = "users";
        $sql = "DELETE FROM $tableName WHERE id = $rowId";
       

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            $log_sql = "INSERT INTO user_log (user_id, activities) VALUES('$user_id','Deleted user id $rowId')";
            $conn->query($log_sql);
            echo "Row with ID $rowId deleted successfully from table $tableName";
            header("Location:../user.php?deleted=true");
        } else {
            echo "Error deleting row: " . $conn->error;
        }
    }
} else {
    // Handle the case where user_id is not set (e.g., redirect to login page)
    header("Location: .../index.php");
    exit();
}
?>
