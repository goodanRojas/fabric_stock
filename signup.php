<?php
  include("conn.php");
  session_start();

  if($_SERVER['REQUEST_METHOD'] == "POST"){
                $type = '2';
                $fname = $_POST['Firstname'];
                $Lname = $_POST['Lastname'];
                $eml = $_POST['Email'];
                $num = $_POST['Contact_Number'];
                $pass = $_POST['Password'];


                $sql="INSERT INTO users (type_of_user,firstname,lastname,email,contact,pwd) VALUES ('$type','$fname','$Lname','$eml','$num','$pass')";
                mysqli_query($conn,$sql);

               

                
                $_SESSION['check'] = true;
                
                header("Location: index.php");
                



  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="design/signup.css">
    <title>Sign up </title>
</head>
<body>
    <form action="signup.php" method="post">
    <div class="Portal">
                <h1>Create Your Account</h1>

                

                <div class=" input">
                    <input type="text" placeholder="Firstname" name="Firstname" required>
                    </div>
                <div class=" input">
                    <input type="text" placeholder="Lastname" name="Lastname" required>
                </div>
                    <div class=" input">
                        <input type="email" placeholder="Email" name="Email" required>
                        </div>


            <div class=" input">
            <input type="tel" placeholder="Contact Number" name="Contact_Number" required>
            </div>
            
             

            <div class=" input">
                <input type="password" placeholder="Password" name="Password" required>

            </div>

            

            <div class="submit">
                 <input type="submit" value="Sign up" name="Signup" >
            </div>
            
            <div class="Register">

                <p>
                    Already have an account? <a href = "index.php"> click here!</a>
                </p>

            </div>
 
    </div>
</form>
</body>
</html>