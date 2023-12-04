
<?php
  include 'config.php';  
  session_start();
  $user_id = $_SESSION['user_id'];
    // Check if the form is submitted
    if (isset($_POST['insertdata'])) {
       // Generate a path for the uploaded file
       $target = "../img/web/".basename($_FILES['image']['name']);
        
       
        $image = $_FILES['image']['name'];
        $type = $_POST['type'];
        $color = $_POST['color'];
        $price = $_POST['price'];
        $addr = $_POST['caddr'];
        $sql = "INSERT INTO fabric (image_name, type, color, price, current_stock_address) VALUES ('$image', '$type', '$color', '$price', '$addr')";
        $result = $conn->query($sql);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        
        
        // Insert the file path into the database
        
        $log_sql = "INSERT INTO user_log (user_id, activities) VALUES('$user_id','Added a fabric')";
        $conn->query($log_sql);
        if ($result) {
            // Insert successful
            echo "Fabric added successfully.";
            header("Location: ../stock.php?");

        } else {
            // Insert failed
            echo "Error adding fabric: " . $conn->error;
        }
                  
    }
    
    
    if (isset($_POST['Uinsertdata'])) {
       // Generate a path for the uploaded file
       $target = "../img/web/".basename($_FILES['image']['name']);
        
       
        $image = $_FILES['image']['name'];
        $type = $_POST['type'];
        $color = $_POST['color'];
        $price = $_POST['price'];
        $addr = $_POST['caddr'];
        $sql = "INSERT INTO fabric (image_name, type, color, price, current_stock_address) VALUES ('$image', '$type', '$color', '$price', '$addr')";
        $result = $conn->query($sql);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        
        
        // Insert the file path into the database
        
        $log_sql = "INSERT INTO user_log (user_id, activities) VALUES('$user_id','Added a fabric')";
        $conn->query($log_sql);
        if ($result) {
            // Insert successful
            echo "Fabric added successfully.";
            header("Location: ../ustock.php?");

        } else {
            // Insert failed
            echo "Error adding fabric: " . $conn->error;
        }
                  
    }
    
    
?>
