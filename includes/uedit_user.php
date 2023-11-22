<?php
    session_start();
    include 'config.php';
    $id = $_POST['id'];

    $qry = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $qry);
    $row = mysqli_fetch_array($result);
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

    <form action="uedit_user.php" method="POST"  enctype="multipart/form-data">
       

        <label for="fisrtname">First Name</label>
        <input type="text" id="firstname" name="firstname" value="<?php echo $row['firstname']; ?>">

        <label for="lastname">Last Name</label>
        <input type="text" id="lastname" name="lastname" value="<?php echo $row['lastname']; ?>">

        <label for="email">Email</label>
        <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>">

        <label for="contact">Contact</label>
        <input type="text" id="contact" name="contact" value="<?php echo $row['contact']; ?>">

        <label for="name">Profile</label>
        <input type="file" id="name" name="image">

        
        <input type="hidden" name="id" value="<?php echo $id;?>">
        
        <button type="submit" name="upload">Update</button>

    </form>
    <div class="back">
        <a href="../uprofile.php">Back to the Profile Page</a>
    </div>
 </body>
 </html>


    <?php

?>
<?php
    
  
    // Check if the form is submitted

        if (isset($_POST['upload'])) {
            
          
            $target = "../img/profile_image/".basename($_FILES['image']['name']);
        
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];
            $image = $_FILES['image']['name'];
            $tmpimage = $_FILES['image']['tmp_name'];
          
            if($firstname == "")
            {
                $sql = "UPDATE users SET image_name = '$image', lastname = '$lastname', email = '$email', contact = '$contact' WHERE id = $id";
                $result = $conn->query($sql);
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
            
                $user_id = $_SESSION['user_id'];
                $log_sql = "INSERT INTO user_log (user_id, activities) VALUES('$user_id','Updated a row')";
                $conn->query($log_sql);
                $conn->close();
            
                header("Location: ../uprofile.php?updated=true");
                exit();
            }
            else if($lastname == "")
            {
                // Update user data
                $sql = "UPDATE users SET image_name = '$image', firstname = '$firstname',  email = '$email', contact = '$contact' WHERE id = $id";
                $result = $conn->query($sql);
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
            
                $user_id = $_SESSION['user_id'];
                $log_sql = "INSERT INTO user_log (user_id, activities) VALUES('$user_id','Updated a row')";
                $conn->query($log_sql);
                $conn->close();
            
                header("Location: ../uprofile.php?updated=true");
                exit();
            }
            elseif($email == "")
            {
                // Update user data
                $sql = "UPDATE users SET image_name = '$image', firstname = '$firstname', lastname = '$lastname', contact = '$contact' WHERE id = $id";
                $result = $conn->query($sql);
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
            
                $user_id = $_SESSION['user_id'];
                $log_sql = "INSERT INTO user_log (user_id, activities) VALUES('$user_id','Updated a row')";
                $conn->query($log_sql);
                $conn->close();
            
                header("Location: ../uprofile.php?updated=true");
                exit();
            }
            elseif($contact == "")
            {
                // Update user data
                $sql = "UPDATE users SET image_name = '$image', firstname = '$firstname', lastname = '$lastname', email = '$email' WHERE id = $id";
                $result = $conn->query($sql);
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
            
                $user_id = $_SESSION['user_id'];
                $log_sql = "INSERT INTO user_log (user_id, activities) VALUES('$user_id','Updated a row')";
                $conn->query($log_sql);
                $conn->close();
            
                header("Location: ../uprofile.php?updated=true");
                exit();
            }
            elseif($image == "")
            {
                // Update user data
                $sql = "UPDATE users SET  firstname = '$firstname', lastname = '$lastname', email = '$email', contact = '$contact' WHERE id = $id";
                $result = $conn->query($sql);
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
            
                $user_id = $_SESSION['user_id'];
                $log_sql = "INSERT INTO user_log (user_id, activities) VALUES('$user_id','Updated a row')";
                $conn->query($log_sql);
                $conn->close();
            
                header("Location: ../uprofile.php?updated=true");
                exit();
            }
        }
    
    
    
?>
