<?php
include 'includes/config.php';
session_start();
$user_id = $_SESSION['user_id'];
$image = "SELECT image_name FROM users where id = $user_id";
$result_image = mysqli_query($conn, $image);
$row1 = $result_image->fetch_assoc();
?>

<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/table.css">
    <link rel="stylesheet" href="./style/top.css">
    <link rel="stylesheet" href="./style/livesearch.css">
    <link rel="stylesheet" href="./style/modal.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Admin Dashboard Panel</title>
</head>

<body>


    <nav>
        <div class="nav-profile-card">
            <span class="nav-profile-image">
                <img src="img/profile_image/<?php echo $row1['image_name']; ?>" width='100' height='100'>
            </span>

            <span class="nav-profile-name">
                <?php
                $qry = "SELECT CONCAT(firstname, ' ' , lastname) AS name from users where id = $user_id";
                $result = mysqli_query($conn, $qry);
                $row = $result->fetch_assoc();
                echo $row['name'];
                ?>
            </span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="udashboard.php">
                        <img src="./img/nav-icons/dashboard.png" class="icon" alt="icon">
                        <span class="link-name">Dashboard</span>
                    </a></li>
                <li><a href="ustock.php">
                        <img src="./img/nav-icons/stock.png" class="icon" alt="icon">
                        <span class="link-name">Stocks</span>
                    </a></li>


                <li><a href="uprofile.php">
                        <img src="./img/nav-icons/account.png" class="icon" alt="icon">
                        <span class="link-name">Profile</span>
                    </a></li>

                <li class="open-button">
                    <i class="uil uil-signout"></i>
                    <span class="link-name" id="openModalBtn">Logout</span>
                </li>


            </ul>




        </div>
    </nav>
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">

            <p> Do you really wanna log out?</p>
            <div class="modal-choice">
                <span class="close btn" id="closeModalBtn">No</span>
                <a class="btn" href="index.php">Yes</a>

            </div>

        </div>

    </div>


    <section class="dashboard">
        <!-- THis is a comment -->
        <div class="boxes">
            <h2>Total</h2>
            <div class="box1 box">
                <span class="text">Users</span>
                <a href="user.php">
                    <span class="number">
                        <?php
                        $query = "SELECT COUNT(*) FROM users";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_array($result);
                        $count = $row[0];
                        echo $count;
                        ?>
                    </span>
                </a>
            </div>


            <div class="box2 box">
                <span class="text">Fabric</span>
                <span class="number">
                    <?php
                    $query = "SELECT COUNT(*) FROM `fabric`";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_array($result);
                    $count = $row[0];
                    echo $count;
                    ?>
                </span>
            </div>

            <div class="box3 box">
                <span class="text">User Logs</span>
                <span class="number">
                    <?php
                    $query = "SELECT COUNT(*) FROM user_log";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_array($result);
                    $count = $row[0];
                    echo $count;
                    ?>
                </span>
            </div>



        </div>


    </section>


    <footer>
        Created by: FSCS

    </footer>



</body>

</html>

<script>
    // Get the modal and the buttons
    var modal = document.getElementById("myModal");
    var openModalBtn = document.getElementById("openModalBtn");
    var closeModalBtn = document.getElementById("closeModalBtn");

    // Open the modal
    openModalBtn.onclick = function () {
        modal.style.display = "block";
    };

    // Close the modal
    closeModalBtn.onclick = function () {
        modal.style.display = "none";
    };

    // Close the modal if the user clicks outside of it
    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };

</script>