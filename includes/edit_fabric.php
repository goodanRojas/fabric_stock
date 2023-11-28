<?php
include 'config.php';
   

$id = intval($_POST["id"]);
$qry = "SELECT * FROM fabric where id = $id";

$result = $conn->query($qry);

// Check if the query was successful
if ($result && $result->num_rows > 0) 
{
    $row = $result->fetch_assoc();
    ?>

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

    <form action="edit_fabric.php" method="post"  enctype="multipart/form-data">
       

        <label for="type">Type</label>
        <input type="text" id="type" name="type" value="<?php echo $row['type']; ?>">

        <label for="color">Color</label>
        <input type="text" id="color" name="color" value="<?php echo $row['color']; ?>">

        <label for="price">Price</label>
        <input type="text" id="price" name="price" value="<?php echo $row['price']; ?>">

        <label for="addr">Address</label>
        <input type="text" id="addr" name="addr" value="<?php echo $row['current_stock_address']; ?>">

        <label for="image">Image</label>
        <input type="file" id="image" name="image" value="<?php echo $row['image_name']; ?>">

        
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <button type="submit" name="upload">Update</button>

    </form>
    <div class="back">
        <a href="../stock.php">Back to the Use Page</a>
    </div>
 </body>
 </html>


    <?php
}
?>
<?php
    
    session_start();
    // Check if the form is submitted
    if(isset($_SESSION['user_id']))
    {
        if (isset($_POST['upload'])) {
            // Define the upload directory
            $user_id = $_SESSION['user_id'];
            $target = "../img/web/".basename($_FILES['image']['name']);

            $type = $_POST['type'];
            $color = $_POST['color'];
            $price = $_POST['price'];
            $id = $_POST['id'];
            $addr = $_POST['addr'];
            $image = $_FILES['image']['name'];
          
            $sql = "UPDATE fabric SET image_name = '$image', type = '$type', color = '$color', price = '$price', current_stock_address = '$addr' WHERE id = $id";
            $result = $conn->query($sql);
            if(move_uploaded_file($_FILES['image']['tmp_name'], $target))
            {
    
            }
      
                
                $log_sql = "INSERT INTO user_log (user_id, activities) VALUES('$user_id','Updated fabric row id  $id')";
                $conn->query($log_sql);
                $conn->close();
    
                header("Location: ../stock.php?updated=true");
    
        }
    }
    
    
?>
