<?php
include "includes/config.php";
?> 
<style>
    
img.fabric_image{
    width: 50px;
    height: 30px;
    border-radius: 5px;
}

button.add_fabric{
    border:none;
    padding: 10px 17px ;
    background-color: mediumspringgreen;
    border-radius: 5px;
    margin-left: 20px;
    cursor: pointer;
}
button.add_fabric:hover{
    border: solid 1.5px black;
    background-color: rgb(0, 250, 42);
   
}

</style>
<?php

if (isset($_POST['input'])) {
    $input = mysqli_real_escape_string($conn, $_POST['input']); // Sanitize user input to prevent SQL injection

   /*  $qry = "SELECT CONCAT(firstname, ' ', lastname) AS `name`, `id`, `gender`, `contact`, `email`, `date_created` FROM users WHERE firstname ILIKE '%{$input}%' OR lastname ILIKE '%{$input}%' OR `email` ILIKE '%{$input}%' OR `contact` ILIKE '%{$input}%' OR `gender` ILIKE '%{$input}%' OR `date_created` ILIKE '%{$input}%'";
 */
    $qry = "SELECT id, CONCAT(firstname,' ', lastname) AS name, email, contact, image_name, date_inserted, date_updated FROM users WHERE firstname LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR lastname LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `email` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `contact` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `image_name` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `date_inserted` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `date_updated` LIKE '%$input%' COLLATE utf8mb4_unicode_ci";

    $result = mysqli_query($conn, $qry);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $i = 1;
            
            echo '<table class="table table-bordered table-stripped"  id="data-table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>#</th>';
            echo '<th>Name</th>';
            echo '<th>Email</th>';
            echo '<th>Contact</th>';
            echo '<th>Profile</th>';
            echo '<th>Joined date</th>';
            echo '<th colspan="2" >Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $i++ . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['contact'] . "</td>";
                echo "<td>" . $row['date_inserted'] . "</td>";
                echo "<td> <img src='img/profile_image/".$row['image_name']."' class=''> </td>";
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
