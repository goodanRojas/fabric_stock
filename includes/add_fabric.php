
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <style>
         form {
        max-width: 400px;
        margin: 0 auto;
    }

    label {
        display: block;
        margin-top: 10px;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="radio"] {
        margin-right: 5px;
        
    }

    .btn {
        background-color: #007BFF;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #0056b3;
    }
    .back{
        display: flex;
        width: 200px;
        height: 50px;
        background-color: rgb(174, 148, 217);
        
        justify-content: center;
        align-items: center;
        border-radius: 25px;
    
    }
    a{
        display: block;
        /* width: 100%;
        height: 100%; */
        text-align: center;
        text-decoration: none;
        
    }            

    </style>
 </head>
 <body>

    <form action="add_fabric.php" method="post"  enctype="multipart/form-data">
       

        <label for="type">Type</label>
        <input type="text" id="type" name="type" placeholder="Type of fabric" >

        <label for="color">Color</label>
        <input type="text" id="color" name="color" placeholder="Color of fabric">

        <label for="price">Price</label>
        <input type="text" id="price" name="price" placeholder="Price of fabric" >

        <label for="addr">Address</label>
        <input type="text" id="addr" name="addr" placeholder="Address of fabric">

        <label for="image">Image</label>
        <input type="file" id="image" name="image" >

        
       
        <button type="submit" name="upload">Add</button>

    </form>
    <div class="back">
        <a href="../stock.php">Back to the Stocks Page</a>
    </div>
 </body>
 </html>


  
<?php
  include 'config.php';  
  session_start();
  $user_id = $_SESSION['user_id'];
    // Check if the form is submitted
    if (isset($_POST['upload'])) {
       // Generate a path for the uploaded file
       $target = "../img/web/".basename($_FILES['image']['name']);
        
       
        $image = $_FILES['image']['name'];
        $type = $_POST['type'];
        $color = $_POST['color'];
        $price = $_POST['price'];
        $addr = $_POST['addr'];
        $sql = "INSERT INTO fabric (image_name, type, color, price, current_stock_address) VALUES ('$image', '$type', '$color', '$price', '$addr')";
        $result = $conn->query($sql);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        
        
        // Insert the file path into the database
        
        $log_sql = "INSERT INTO user_log (user_id, activities) VALUES('$user_id','Added a row')";
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
    
    
?>
