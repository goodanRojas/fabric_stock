<?php
include 'includes/config.php';
session_start();
$user_id = $_SESSION['user_id'];



$image = "SELECT CONCAT(firstname, ' ', lastname) as name, email, contact, type_of_user, pwd , image_name, date_inserted FROM users where id = $user_id";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        .dashboard {
            height: 100vh;
            /* Set the height to 100% of the viewport height */
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            /* Dark Blue Background */
            color: #fff;
            /* White Text Color */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 51, 102, 0.1);
            /* Light Blue Shadow */
        }

        .profile-card {
            background-color: #ffffff;
            /* White Background */
            border: none;
            width: 50%;
            /* Remove the border */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 51, 102, 0.1);
            /* Light Blue Shadow */
            text-align: center;
            /* Center the content */
            margin-top: 20px;
        }

        .profile-card .table-btn {
            background-color: #3498db;
            /* Dark Blue Button Background */
            color: #fff;
            /* White Text Color */
            padding: 10px 15px;
            /* Add padding to the button */
            border: none;
            /* Remove button border */
            border-radius: 5px;
            /* Add button border-radius */
            cursor: pointer;
            /* Change cursor to pointer on hover */
        }

        .personal-logs {


            background-color: #ffffff;
            /* White Background */
            border: none;
            width: 50%;
            /* Remove the border */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 51, 102, 0.1);
            /* Light Blue Shadow */
            text-align: center;
            /* Center the content */
            margin-top: 20px;
            height: 100vh;
            /* Set default height to 100% of the viewport height */
            overflow-y: auto;
            /* Add a vertical scrollbar if content overflows */
        }


        .profile-image img {
            border: 2px solid blue;
            /* Remove the border */
            width: 170px;
            height: 170px;
            border-radius: 50%;
            /* Make it a circle */
        }


        .profile-name {
            color: #003366;
            /* Dark Blue Text Color */
            font-size: 1.5em;
            /* Larger font size */
            font-weight: bold;
            /* Bold font weight */
            margin-top: 10px;
            /* Space from the image */
        }

        .profile-details {
            margin-top: 20px;
            /* Space from the profile name */
        }

        .details {
            margin-bottom: 10px;
            /* Space between details */
        }

        .text {
            color: #003366;
            /* Dark Blue Text Color */
        }

        .submit input {
            background-color: #3498db;
            /* Dark Blue Button Background */
            color: #fff;
            /* White Text Color */
            padding: 10px 15px;
            /* Add padding to the button */
            border: none;
            /* Remove button border */
            border-radius: 5px;
            /* Add button border-radius */
            cursor: pointer;
            /* Change cursor to pointer on hover */
        }
    </style>



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

                echo $row1['name'];
                ?>
            </span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="dashboard.php">
                        <img src="./img/nav-icons/dashboard.png" class="icon" alt="icon">
                        <span class="link-name">Dashboard</span>
                    </a></li>
                <li><a href="stock.php">
                        <img src="./img/nav-icons/stock.png" class="icon" alt="icon">
                        <span class="link-name">Stocks</span>
                    </a></li>
                <li><a href="user.php">
                        <img src="./img/nav-icons/user-list.png" class="icon" alt="icon">
                        <span class="link-name">User's List</span>
                    </a></li>

                <li style="background-color:#4563c47b;
                            border-radius: 0 20px 20px 0;
                            padding: 3px 7px 3px 5px;
                            "><a href="profile.php">
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


    <div class="modal fade" id="usereditmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit user data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <?php 
                    $qry = "SELECT * FROM users WHERE id = $user_id";
                    $result = mysqli_query($conn, $qry);
                    $row2 = mysqli_fetch_assoc($result);
                ?>
                <form action="includes/edit_user.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">


                        <div class="input-group">
                            <span class="input-group-text">First and last name</span>
                            <input type="text" name="firstname" id="Efname" aria-label="First name"
                                value="<?php echo $row2['firstname'] ?>" class="form-control">
                            <input type="text" name="lastname" id="Elname" aria-label="Last name"
                                value="<?php echo $row2['lastname'] ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" id="Eemail" class="form-control"
                                aria-describedby="emailHelp" placeholder="Enter email"
                                value="<?php echo $row2['email'] ?>">

                        </div>
                        <div class="form-group">
                            <label for="contact">Contact</label>
                            <input type="tel" name="contact" class="form-control" id="Econtact"
                                aria-describedby="emailHelp" placeholder="Enter Phone number"
                                value="<?php echo $row2['contact'] ?>">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="pass" class="form-control" id="Epass" placeholder="Password"
                                value="<?php echo $row2['pwd'] ?>">
                        </div>
                        <div class="form-check">
                            <h5 class="title">User type</h5>
                            <input class="form-check-input" name="user_type" type="radio" id="Euser_type"
                                name="flexRadioDefault" id="flexRadioDefault1" value="1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Admin
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="user_type" id="Euser_type"
                                name="flexRadioDefault" id="flexRadioDefault2" checked value="2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                User
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Insert an image</label>
                            <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                        </div>


                        <input type="hidden" name="user_id" id="update_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="inserdata" class="btn btn-primary">Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <section class="dashboard">
        <div class="profile-card">
            <div class="data-list profile-image">
                <img src="img/profile_image/<?php echo $row1['image_name']; ?>" alt="Profile Image">
            </div>

            <span class="profile-name">
                <?php

                echo $row1['name'];
                ?>
            </span>

            <div class="profile-details">
                <div class="details">
                    <p class="text">Email:
                        <?php echo $row1['email']; ?>
                    </p>
                </div>

                <div class="details">
                    <p class="text">Contact:
                        <?php echo $row1['contact']; ?>
                    </p>
                </div>

                <div class="details">
                    <p class="text">Password:
                        <?php echo $row1['pwd']; ?>
                    </p>
                </div>

                <div class="details">
                    <p class="text">Date joined:
                        <?php echo $row1['date_inserted']; ?>
                    </p>
                </div>
            </div>

            <button type='button' class='btn btn-success editbtn'> EDIT </button>

        </div>


        <div class="personal-logs">
            <h2 class="text">Recent Activities</h2>
            <table>

                <?php
                $qry = "SELECT * FROM user_log WHERE user_id = $user_id";
                $result = mysqli_query($conn, $qry);
                if ($row = mysqli_fetch_assoc($result) > 0) {
                    ?>
                    <tr>
                        <th>Activities</th>
                        <th>Date</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["activities"] . "</td>";
                        echo "<td>" . $row["date_inserted"] . "</td>";
                    }
                } else {
                    echo "<p class='text'>No recent activities </p>";
                }
                ?>
            </table>
        </div>

    </section>

    <footer>
    FABRIC STOCK - created by FS [BSIT 201] 

    </footer>
    <script src="jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
<script>


    $(document).ready(function () {
        $(".editbtn").on('click', function () {
            $("#usereditmodal").modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();



        });
    });





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