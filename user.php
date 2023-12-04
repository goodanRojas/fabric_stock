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
    <title>Profile</title>
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
                <li><a href="dashboard.php">
                        <img src="./img/nav-icons/dashboard.png" class="icon" alt="icon">
                        <span class="link-name">Dashboard</span>
                    </a></li>
                <li><a href="stock.php">
                        <img src="./img/nav-icons/stock.png" class="icon" alt="icon">
                        <span class="link-name">Stocks</span>
                    </a></li>
                <li style="background-color:#4563c47b;
                            border-radius: 0 20px 20px 0;
                            padding: 3px 7px 3px 5px;
                            "
                    
                ><a href="user.php">
                        <img src="./img/nav-icons/user-list.png" class="icon" alt="icon">
                        <span class="link-name">User's List</span>
                    </a></li>

                <li><a href="profile.php">
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
               <a class="btn"href="index.php">Yes</a>

            </div>

        </div>

    </div>

<!-- The code below id for adding a new user -->
    <div class="modal fade" id="useraddmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add user data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="includes/add_user.php" method="post" enctype="multipart/form-data">
        <div class="modal-body">
        
       
            <div class="input-group">
                <span class="input-group-text">First and last name</span>
                <input type="text" name="firstname" aria-label="First name" class="form-control">
                <input type="text" name="lastname" aria-label="Last name" class="form-control">
             </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                
            </div>
            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="tel" name="contact"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Phone number">
                
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-check">
                <h5 class="title">User type</h5>
                <input class="form-check-input" name="user_type" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="1">
                <label class="form-check-label" for="flexRadioDefault1">
                    Admin
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="user_type" name="flexRadioDefault" id="flexRadioDefault2" checked value="2">
                <label class="form-check-label" for="flexRadioDefault2">
                    User
                </label>
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">Insert an image</label>
                <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
            </div>

           
                        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="inserdata" class="btn btn-primary">Save Data</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- THE CODE BELOW IS FOR EDIT DATA -->
<div class="modal fade" id="usereditmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit user data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="includes/edit_user_list.php" method="post" enctype="multipart/form-data">
        <div class="modal-body">
        
       
            <div class="input-group">
                <span class="input-group-text">First and last name</span>
                <input type="text" name="firstname" id="Efname" aria-label="First name" class="form-control">
                <input type="text" name="lastname" id="Elname" aria-label="Last name" class="form-control">
             </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" id="Eemail" class="form-control"  aria-describedby="emailHelp" placeholder="Enter email">
                
            </div>
            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="tel" name="contact"class="form-control" id="Econtact" aria-describedby="emailHelp" placeholder="Enter Phone number">
                
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="pass" class="form-control" id="Epass" placeholder="Password">
            </div>
            <div class="form-check">
                <h5 class="title">User type</h5>
                <input class="form-check-input" name="user_type" type="radio" id="Euser_type" name="flexRadioDefault" id="flexRadioDefault1" value="1">
                <label class="form-check-label" for="flexRadioDefault1">
                    Admin
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="user_type" id="Euser_type" name="flexRadioDefault" id="flexRadioDefault2" checked value="2">
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

<!-- DELETE MODAL -->
<div class="modal fade" id="userdeletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete user data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="includes/user-delete.php" method="post">
        <div class="modal-body">
        
            <h3>Are you sure you want to delete?</h2>
            <input type="hidden" name="delete_id" id="delete_id">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit"  name="deletedata" class="btn btn-primary">Delete Data</button>
        </div>
      </form>
    </div>
  </div>
</div>





    <section class="dashboard">
        <div class="top">
                
                    <input type="text" class="search-box" id="live-search" name="search" autocomplete="off" placeholder="Search User">

                    
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#useraddmodal">
                    Add User
                    </button>  


                   
                     
                                     <!-- $_SESSION
                                     mag add og image sa database  -->
                                
                               
                <!-- Ang imo sa buhaton unsaon pag gamit og search bar para maka search og data sa table -->
                <!-- Human ana mag himo ka og ajax para alid an ang table depende sa result sa search bar -->
        </div>

        <div class="count">
                       <div>
                            <span class="text">Total users</span>
                       </div>
                        <div>
                            <span class="number">
                                <?php 
                                    
                                    $query = "SELECT COUNT(*) FROM users";
                                    $result = mysqli_query($conn, $query);
                                    $row = mysqli_fetch_array($result);
                                    $count = $row[0];
                                    echo $count;
                                ?>
                            </span>
                        </div>
                    </div>   
                 

        <div class="dash-content">
            <div class="overview">
                 

                <div class="boxes">

                 
                        <table class="table table-bordered table-stripped"  id="data-table">
                        
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Profile</th>
                                    <th>Joined date</th>
                                    <th colspan="2" >Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                    $i = 1;
                                    $qry = "SELECT id, CONCAT(firstname,' ', lastname) AS name, email, contact, image_name, date_inserted, pwd , id  FROM users ORDER BY date_inserted DESC";
                                    $result = $conn->query($qry);
                                    
                                    // Check if the query was successful
                                    if ($result) {
                                        while ($row = $result->fetch_assoc()) {
                                            
                                            echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['contact'] . "</td>";
                                            echo "<td> <img src='img/profile_image/".$row['image_name']."' class='fabric_image'> </td>";
                                            echo "<td>". $row['date_inserted'] ."</td>";
                                        
                                            echo "<td>
                                                    <button type='button' class='btn btn-success editbtn'> EDIT </button>
                                                </td>";

                                                
                                            echo "<td>
                                                <button type='button' class='btn btn-danger deletebtn'> DELETE </button>
                                            </td>";

                                            
                                            echo "</tr>";
                                        }
                                        
                                    } else {
                                        echo "Error executing the query: " . $conn->error;
                                    }
                                    

                                ?>
                                
                            </tbody>
                        </table>

                        <div id="searchresult">
                                
                        </div>
                        
                        <div class="success-box">
                            <?php if (isset($_GET['success'])) { ?>

                            <p class="success" id="success"><?php echo $_GET['error']; ?></p>

                            <?php } ?>
                        </div>

                        
                   
                </div>
                    
            </div>
        </div>    
    </section>

   


    <footer>
    FABRIC STOCK - created by FS [BSIT 201]

    </footer>



    <script src="jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>

    //for editing the useer

$(document).ready(function(){
    $(".editbtn").on('click', function(){
        $("#usereditmodal").modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

       
        $('#update_id').val(data[0]);

        // Splitting the name into first name and last name
        var fullName = data[1].split(' ');
        $('#Efname').val(fullName[0]);
        $('#Elname').val(fullName[1]);

        $('#Eemail').val(data[2]);
        $('#Econtact').val(data[3]);
        $('#Epass').val(data[4]);
        $('#Euser_type').val(data[5]);



    });
});


/* THIS IS FOR DELETING */
$(document).ready(function(){
    $(".deletebtn").on('click', function(){
        $("#userdeletemodal").modal('show');

        // Get the 'id' value from the first <td> in the clicked row
        var rowId = $(this).closest('tr').find('td:first').text();

        // Set the value of the hidden input
        $('#delete_id').val(rowId);
    });
});






</script>


</body>
</html>

   

<script>


$(document).ready(function(){
    $("#logs-table").hide();
    $("#export-table").hide();

    $("#open_lists").click(function (){
        $("#data-table").show();
        $("#export-table").hide();
        $("#logs-table").hide();
    });
    $("#open_logs").click(function (){
        $("#data-table").hide();
        $("#export-table").hide();
        $("#logs-table").show();
    });
    $("#open_exports").click(function (){
        $("#data-table").hide();
        $("#logs-table").hide();
        $("#export-table").show();
    });
});


$(document).ready(function() {
        // Function to log actions via Ajax
        function logAction(userId, action) {
            $.ajax({
                type: 'POST',
                url: 'log_action.php', // Replace with the actual path to your PHP file
                data: { userId: userId, action: action },
                success: function(response) {
                    console.log('Action logged successfully');
                },
                error: function(error) {
                    console.error('Error logging action:', error);
                }
            });
        }

//LIVE SEARCH
        $(document).ready(function () {
    $("#live-search").keyup(function () {
        var input = $(this).val();
         /* alert(input); */    

        if (input != "") {
           
            $.ajax({
                url:'search_user.php',
                method: 'POST',
                data: { input : input },
                
                success: function (data) {
                    $("#searchresult").html(data);
                    $("#data-table").hide();
                    $("#searchresult").show()
                   
                }
            });
        } else {
            $("#searchresult").hide();
            $("#data-table").show();
            $("logs_table").hide();
            $("export-table").hide();
        }
    });
});

        // Example usage
        var userId = 1; // Replace with the actual user ID
        var action = "User clicked a button"; // Replace with the actual action

        logAction(userId, action);
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