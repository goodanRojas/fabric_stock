<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .dashboard {
            margin-top: 20px;
            position: sticky;
            left: 250px;
        }

        .profile-card {
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

        .data-list {
            margin-bottom: 20px;
        }

        .profile-image img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .profile-name {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .profile-details {
            width: 100%;
            text-align: left;
            margin-bottom: 20px;
        }

        .details {
            margin-bottom: 15px;
        }

        .text {
            margin: 0;
        }

        .submit {
            margin-top: 15px;
        }

        .table-btn {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .table-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<?php
include "includes/header.php";
include "includes/navbar.php";
$user_id = $_SESSION['user_id'];
$image = "SELECT * FROM users where id = $user_id";
$result_image = mysqli_query($conn, $image);
$row = $result_image->fetch_assoc();
?>


<section class="dashboard">
    <div class="profile-card">
        <div class="data-list profile-image">
            <img src="img/profile_image/<?php echo $row['image_name']; ?>" alt="Profile Image">
        </div>

        <span class="profile-name"><?php
            $qry = "SELECT CONCAT(firstname ,' ', lastname) AS name from users where id = $user_id";
            $result = mysqli_query($conn, $qry);
            $row1 = $result->fetch_assoc();
            echo $row1['name'];
            ?>
        </span>

        <div class="profile-details">
            <div class="details">
                <p class="text">Email: <?php echo $row['email']; ?></p>
            </div>

            <div class="details">
                <p class="text">Contact: <?php echo $row['contact']; ?></p>
            </div>

            <div class="details">
                <p class="text">Password: <?php echo $row['pwd']; ?></p>
            </div>

            <div class="details">
                <p class="text">Date joined: <?php echo $row['date_inserted']; ?> </p>
            </div>
        </div>

        <form action="includes/edit_user.php" method="post" class="submit">
            <input type='hidden' name='id' value='<?php echo $user_id ?>'>
            <input type='submit' class='table-btn' value='Update'>
        </form>
    </div>
</section>

<?php
include "includes/footer.php";
include "includes/scripts.php";
?>

</body>
</html>
        