<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            max-width: 400px;
            margin: auto;
        }

        label {
            margin-top: 10px;
        }

        input,
        button {
            margin-top: 5px;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        .back {
            margin-top: 15px;
            text-align: center;
            margin-top: 20px;
        }

        .back a {
            color: #333;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <?php
    session_start();
    include 'config.php';
    $id = $_POST['id'];

    $qry = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $qry);
    $row = mysqli_fetch_array($result);
    ?>

    <form action="uedit_user.php" method="POST" enctype="multipart/form-data">

        <label for="firstname">First Name</label>
        <input type="text" id="firstname" required name="firstname" value="<?php echo $row['firstname']; ?>">

        <label for="lastname">Last Name</label>
        <input type="text" id="lastname" required name="lastname" value="<?php echo $row['lastname']; ?>">

        <label for="email">Email</label>
        <input type="text" id="email" required name="email" value="<?php echo $row['email']; ?>">

        <label for="contact">Contact</label>
        <input type="text" id="contact" required name="contact" value="<?php echo $row['contact']; ?>">

        <!-- mao ne ako ge edit na side [athena] -->
        <label for="Password">Password</label>
        <input type="text" id="Password" required name="password" value="<?php echo $row['pwd']; ?>">

        <label for="name">Profile</label>
        <input type="file" id="name" required  name="image">

        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <button type="submit" name="upload">Update</button>

        <div class="back">
            <a href="../uprofile.php">Back to the Profile Page</a>
        </div>

    </form>

    <?php
    if (isset($_POST['upload'])) {
        $target = "../img/profile_image/" . basename($_FILES['image']['name']);

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $pass = $_POST['password'];
        $image = $_FILES['image']['name'];


        // Check if any required field is empty
        if (empty($firstname) || empty($lastname) || empty($email) || empty($contact) || empty($image) || empty($pass)) {
            // Handle the case where a required field is empty
            header("Location: ../uprofile.php?error=Please fill out all fields");
            exit();
        }

        // Update user data
        $sql = "UPDATE users SET image_name = ?, firstname = ?, lastname = ?, email = ?, contact = ?, pwd = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $image, $firstname, $lastname, $email, $contact, $pass, $id);



        if ($stmt->execute()) {
            move_uploaded_file($_FILES['image']['tmp_name'], $target);

           
            $log_sql = "INSERT INTO user_log (user_id, activities) VALUES(?, 'Updated a row')";
            $log_stmt = $conn->prepare($log_sql);
            $log_stmt->bind_param("i", $id);
            $log_stmt->execute();

            $stmt->close();
            $log_stmt->close();
            $conn->close();

            header("Location: ../uprofile.php?updated=true");
            exit();
        } else {
            // Handle the case where the update failed
            header("Location: ../uprofile.php?error=Error updating user data");
            exit();
        }
    }
    ?>

</body>

</html>