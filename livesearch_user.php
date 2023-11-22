<?php
include "includes/config.php";
?> 
<style>
    


</style>
<?php

if (isset($_POST['input'])) {
    $input = mysqli_real_escape_string($conn, $_POST['input']); // Sanitize user input to prevent SQL injection

   /*  $qry = "SELECT CONCAT(firstname, ' ', lastname) AS `name`, `id`, `gender`, `contact`, `email`, `date_created` FROM users WHERE firstname ILIKE '%{$input}%' OR lastname ILIKE '%{$input}%' OR `email` ILIKE '%{$input}%' OR `contact` ILIKE '%{$input}%' OR `gender` ILIKE '%{$input}%' OR `date_created` ILIKE '%{$input}%'";
 */
    $qry = "SELECT  * FROM fabric WHERE type LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR color LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `price` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `current_stock_address` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `image_name` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `date_inserted` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `date_updated` LIKE '%$input%' COLLATE utf8mb4_unicode_ci";

    $result = mysqli_query($conn, $qry);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $i = 1;
            
            echo '<table class="table table-bordered table-stripped"  id="data-table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>#</th>';
            echo '<th>Type</th>';
            echo '<th>Color</th>';
            echo '<th>Price</th>';
            echo '<th>Address</th>';
            echo '<th>image_name</th>';
            echo '<th colspan="2" >Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $i++ . "</td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "<td>" . $row['color'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['current_stock_address'] . "</td>";
                echo "<td> <img src='img/fabric_images/".$row['image_name']."' class='cotton_image' width='100' heigth='50'> </td>";
                echo "<td><form method='post' action='includes/delete.php'><input type='hidden' name='id' value='" . $row['id'] . "'><input type='submit' class='table_btn' value='Delete'></form></td>";
                echo "<td><form method='post' action='includes/edit.php'><input type='hidden' name='id' value='" . $row['id'] . "'><input type='submit' class='table_btn' value='Update'></form></td>";
                echo "</tr>";
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo "<h5>No data found!</h5>";
        }
    } else {
        echo "Query failed: " . $conn->error; // Handle database query errors
    }
}
?>
