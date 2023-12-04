<?php
include "includes/config.php";
?>

<?php

if (isset($_POST['Linput'])) {
    $input = mysqli_real_escape_string($conn, $_POST['Linput']); // Sanitize user input to prevent SQL injection


    /*  $qry = "SELECT CONCAT(firstname, ' ', lastname) AS `name`, `id`, `gender`, `contact`, `email`, `date_created` FROM users WHERE firstname ILIKE '%{$input}%' OR lastname ILIKE '%{$input}%' OR `email` ILIKE '%{$input}%' OR `contact` ILIKE '%{$input}%' OR `gender` ILIKE '%{$input}%' OR `date_created` ILIKE '%{$input}%'";
     */
    $qry = "SELECT  * FROM fabric WHERE type LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR color LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `price` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `current_stock_address` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `image_name` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `date_inserted` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `date_updated` LIKE '%$input%' COLLATE utf8mb4_unicode_ci ORDER BY date_inserted DESC";

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
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "<td>" . $row['color'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['current_stock_address'] . "</td>";
                echo "<td> <img src='img/web/" . $row['image_name'] . "' class='fabric_image'> </td>";
                echo "<td>
                        <button type='button' class='btn btn-success editbtn'> EDIT </button>
                    </td>";


                echo "<td>
                        <button type='button' class='btn btn-danger deletebtn'> DELETE </button>
                    </td>";



                echo "</tr>";
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<table class="table table-bordered table-stripped"  id="data-table">';
            echo '<tr>';
            echo '<th>#</th>';
            echo '<th>Type</th>';
            echo '<th>Color</th>';
            echo '<th>Price</th>';
            echo '<th>Address</th>';
            echo '<th>image_name</th>';
            echo '<th colspan="2" >Action</th>';
            echo '</tr>';
            echo '<tr>';
            echo "<td colspan='7'><h5>No data found!</h5> </td>";
            echo '</tr>';
            echo '</table>';
        }
    } else {
        echo "Query failed: " . $conn->error; // Handle database query errors
    }
}
if (isset($_POST['ULinput'])) {
    $input = mysqli_real_escape_string($conn, $_POST['ULinput']); // Sanitize user input to prevent SQL injection


    /*  $qry = "SELECT CONCAT(firstname, ' ', lastname) AS `name`, `id`, `gender`, `contact`, `email`, `date_created` FROM users WHERE firstname ILIKE '%{$input}%' OR lastname ILIKE '%{$input}%' OR `email` ILIKE '%{$input}%' OR `contact` ILIKE '%{$input}%' OR `gender` ILIKE '%{$input}%' OR `date_created` ILIKE '%{$input}%'";
     */
    $qry = "SELECT  * FROM fabric WHERE type LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR color LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `price` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `current_stock_address` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `image_name` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `date_inserted` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `date_updated` LIKE '%$input%' COLLATE utf8mb4_unicode_ci ORDER BY date_inserted DESC";

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
                echo "<td> <img src='img/fabric_images/".$row['image_name']."' class='fabric_image'> </td>";
            
                
                echo "<td>
                <form method='post' action='uexport.php'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                    <button type='submit' class='btn btn-success'>Export</button>
                </form>
              </td>";
        

                
                echo "</tr>";
        
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<table class="table table-bordered table-stripped"  id="data-table">';
            echo '<tr>';
            echo '<th>#</th>';
            echo '<th>Type</th>';
            echo '<th>Color</th>';
            echo '<th>Price</th>';
            echo '<th>Address</th>';
            echo '<th>image_name</th>';
            echo '<th colspan="2" >Action</th>';
            echo '</tr>';
            echo '<tr>';
            echo "<td colspan='7'><h5>No data found!</h5> </td>";
            echo '</tr>';
            echo '</table>';
        }
    } else {
        echo "Query failed: " . $conn->error; // Handle database query errors
    }
}



if (isset($_POST['listinput'])) {
    $input = mysqli_real_escape_string($conn, $_POST['listinput']); // Sanitize user input to prevent SQL injection


    /*  $qry = "SELECT CONCAT(firstname, ' ', lastname) AS `name`, `id`, `gender`, `contact`, `email`, `date_created` FROM users WHERE firstname ILIKE '%{$input}%' OR lastname ILIKE '%{$input}%' OR `email` ILIKE '%{$input}%' OR `contact` ILIKE '%{$input}%' OR `gender` ILIKE '%{$input}%' OR `date_created` ILIKE '%{$input}%'";
     */
    $qry = "SELECT  * FROM fabric WHERE type LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR color LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `price` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `current_stock_address` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `image_name` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `date_inserted` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `date_updated` LIKE '%$input%' COLLATE utf8mb4_unicode_ci ORDER BY date_inserted DESC";

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
                echo "<td> <img src='img/fabric_images/" . $row['image_name'] . "' class='cotton_image' width='100' heigth='50'> </td>";
                echo "<td><form method='post' action='includes/delete.php'><input type='hidden' name='id' value='" . $row['id'] . "'><input type='submit' class='table_btn' value='Delete'></form></td>";
                echo "<td><form method='post' action='includes/edit.php'><input type='hidden' name='id' value='" . $row['id'] . "'><input type='submit' class='table_btn' value='Update'></form></td>";
                echo "</tr>";
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<table class="table table-bordered table-stripped"  id="data-table">';
            echo '<tr>';
            echo '<th>#</th>';
            echo '<th>Type</th>';
            echo '<th>Color</th>';
            echo '<th>Price</th>';
            echo '<th>Address</th>';
            echo '<th>image_name</th>';
            echo '<th colspan="2" >Action</th>';
            echo '</tr>';
            echo '<tr>';
            echo "<td colspan='7'><h5>No data found!</h5> </td>";
            echo '</tr>';
            echo '</table>';
        }
    } else {
        echo "Query failed: " . $conn->error; // Handle database query errors
    }
}










if (isset($_POST['loginput'])) {
    $input = mysqli_real_escape_string($conn, $_POST['loginput']); // Sanitize user input to prevent SQL injection

    /*  $qry = "SELECT CONCAT(firstname, ' ', lastname) AS `name`, `id`, `gender`, `contact`, `email`, `date_created` FROM users WHERE firstname ILIKE '%{$input}%' OR lastname ILIKE '%{$input}%' OR `email` ILIKE '%{$input}%' OR `contact` ILIKE '%{$input}%' OR `gender` ILIKE '%{$input}%' OR `date_created` ILIKE '%{$input}%'";
     */
    $qry = "SELECT  * FROM user_log WHERE activties LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR date_inserted LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `id` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `user_id` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `image_name` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `date_inserted` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `date_updated` LIKE '%$input%' COLLATE utf8mb4_unicode_ci ORDER BY date_inserted DESC";

    $result = mysqli_query($conn, $qry);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {


            echo '<table class="table table-bordered table-stripped"  id="data-table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>#</th>';
            echo '<th>Status</th>';
            echo '<th>User</th>';
            echo '<th>Date</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td>" . $row['date_created'] . "</td>";
                echo "</tr>";
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<table class="table table-bordered table-stripped"  id="data-table">';
            echo '<tr>';
            echo '<th>#</th>';
            echo '<th>Status</th>';
            echo '<th>User</th>';
            echo '<th>Date</th>';
            echo '</tr>';
            echo '<tr>';
            echo "<td colspan='7'><h5>No data found!</h5> </td>";
            echo '</tr>';
            echo '</table>';
        }
    } else {
        echo "Query failed: " . $conn->error; // Handle database query errors
    }
}











if (isset($_POST['exportinput'])) {
    $input = mysqli_real_escape_string($conn, $_POST['exportinput']); // Sanitize user input to prevent SQL injection

    /*  $qry = "SELECT CONCAT(firstname, ' ', lastname) AS `name`, `id`, `gender`, `contact`, `email`, `date_created` FROM users WHERE firstname ILIKE '%{$input}%' OR lastname ILIKE '%{$input}%' OR `email` ILIKE '%{$input}%' OR `contact` ILIKE '%{$input}%' OR `gender` ILIKE '%{$input}%' OR `date_created` ILIKE '%{$input}%'";
     */
    $qry = "SELECT  * FROM exports WHERE type LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR color LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `price` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `current_stock_address` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `image_name` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `date_inserted` LIKE '%$input%' COLLATE utf8mb4_unicode_ci OR `date_updated` LIKE '%$input%' COLLATE utf8mb4_unicode_ci ORDER BY date_inserted DESC";

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
                echo "<td> <img src='img/fabric_images/" . $row['image_name'] . "' class='cotton_image' width='100' heigth='50'> </td>";
                echo "</tr>";
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<table class="table table-bordered table-stripped"  id="data-table">';
            echo '<tr>';
            echo '<th>#</th>';
            echo '<th>Type</th>';
            echo '<th>Color</th>';
            echo '<th>Price</th>';
            echo '<th>Address</th>';
            echo '<th>image_name</th>';
            echo '<th colspan="2" >Action</th>';
            echo '</tr>';
            echo '<tr>';
            echo "<td colspan='7'><h5>No data found!</h5> </td>";
            echo '</tr>';
            echo '</table>';
        }
    } else {
        echo "Query failed: " . $conn->error; // Handle database query errors
    }
}












?>