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
    <style>
        .table_btn.btn-danger{
    background-color: gainsboro;
}


.table_btn.btn-danger:hover{
    background-color: red;
}
.table_btn.btn-safe{
    background-color: gainsboro;
}


.table_btn.btn-safe:hover{
    background-color: rgb(0, 255, 21);
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
                <li
                style="background-color:#4563c47b;
                            border-radius: 0 20px 20px 0;
                            padding: 3px 7px 3px 5px;
                            "><a href="stock.php">
                        <img src="./img/nav-icons/stock.png" class="icon" alt="icon">
                        <span class="link-name">Stocks</span>
                    </a></li>
                <li><a href="user.php">
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

    <!-- Modal for adding new fabric -->

    <div class="modal fade" id="fabricaddmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add fabric data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="includes/add_fabric.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                    
                
                        
                    
                            <label for="type">Type</label>
                            <input type="text" name="type"class="form-control" id="type" aria-describedby="emailHelp" placeholder="Enter Type of fabric">
                        
                            <label for="color">Color</label>
                            <input type="text" name="color"class="form-control" id="color" aria-describedby="emailHelp" placeholder="Enter fabric color">
                    
                            <label for="color">Price</label>
                            <input type="text" name="price"class="form-control" id="price" aria-describedby="emailHelp" placeholder="Enter fabric Price">
                    
                            <label for="caddr">Current address</label>
                            <input type="text" name="caddr"class="form-control" id="caddr" aria-describedby="emailHelp" placeholder="Enter current stock address ">
                    
                            <label for="exampleFormControlFile1">Insert an image</label>
                            <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                        

                    
                                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete fabric data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="includes/fabric-delete.php" method="post">
                <div class="modal-body">
                
                    <h3>Are you sure you want to delete this data?</h2>
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



<!-- UPDATE/EDIT MODAL -->
<div class="modal fade" id="fabriceditmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit  fabric data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="includes/edit_fabric.php" method="post" enctype="multipart/form-data">
        <div class="modal-body">
        
       
            
          
                <label for="type">Type</label>
                <input type="text" name="type"class="form-control" id="type" aria-describedby="emailHelp" placeholder="Enter Type of fabric">
              
                <label for="color">Color</label>
                <input type="text" name="color"class="form-control" id="color" aria-describedby="emailHelp" placeholder="Enter fabric color">
          
                <label for="color">Price</label>
                <input type="text" name="price"class="form-control" id="price" aria-describedby="emailHelp" placeholder="Enter fabric Price">
          
                <label for="caddr">Current address</label>
                <input type="text" name="caddr"class="form-control" id="caddr" aria-describedby="emailHelp" placeholder="Enter current stock address ">
          
                <label for="exampleFormControlFile1">Insert an image</label>
                <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
            
                <input type="hidden" name="update_id" id="update_id">
           
                        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
        </div>
      </form>
    </div>
  </div>
</div>


    <section class="dashboard">
        <div class="top">
                
                    <input type="text" class="search-box" id="live-search" name="search" autocomplete="off" placeholder="Search fabric">

                    <div class="count">
                       <div>
                            <span class="text">Total Fabrics</span>
                       </div>
                        <div>
                        <span class="number">
                            <?php 
                                include("includes/config.php");
                                $query = "SELECT COUNT(*) FROM fabric";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_array($result);
                                $count = $row[0];
                               
                                 echo $count;
                            ?>
                        </span>
                        </div>
                    </div>   
                   
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#fabricaddmodal">
                        Add Fabric
                        </button>  
                    


                   
                     
                                     <!-- $_SESSION
                                     mag add og image sa database  -->
                                
                               
                <!-- Ang imo sa buhaton unsaon pag gamit og search bar para maka search og data sa table -->
                <!-- Human ana mag himo ka og ajax para alid an ang table depende sa result sa search bar -->
        </div>

        <ul class="table_nav" id="table_nav">
                        <li><a href="#" id="open_lists" class="fabric_list links" >Lists</a></li>
                        <li><a href="#" id="open_logs" class="fabric_log links" > Logs</a></li>
                        <li><a href="#" id="open_exports" class="fabric_log links"  >Exports</a></li>
                    </ul>

        <div class="dash-content">
            <div class="overview">
                 

                <div class="boxes">

                 
                        <table class="table table-bordered table-stripped"  id="data-table">
                        
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Color</th>
                                    <th>Price</th>
                                    <th>Address</th>
                                    <th>image_name</th>
                                    <th colspan="2" >Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                 
                                    $qry = "SELECT * FROM fabric ORDER BY date_inserted DESC";
                                    $result = $conn->query($qry);
                                    
                                    // Check if the query was successful
                                    if ($result) {
                                        while ($row = $result->fetch_assoc()) {
                                            
                                            echo "<tr>";
                                            echo "<td>" .$row['id'] . "</td>";
                                            echo "<td>" . $row['type'] . "</td>";
                                            echo "<td>" . $row['color'] . "</td>";
                                            echo "<td>" . $row['price'] . "</td>";
                                            echo "<td>" . $row['current_stock_address'] . "</td>";
                                            echo "<td> <img src='img/web/".$row['image_name']."' class='fabric_image'> </td>";
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
                        <?php 
                            include "exports.php";
                            include "logs.php";
                        ?>
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



<script>





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


$(document).ready(function(){
    $(".editbtn").on('click', function(){
        $("#fabriceditmodal").modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

       
        $('#update_id').val(data[0]);

       
        $('#type').val(date[1]);

        $('#color').val(data[2]);
        $('#price').val(data[3]);
        $('#caddr').val(data[4]);
        $('#imaga').val(data[5]);
       



    });
});








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


//TODO dapat inig click sa button ma change ang or maadan og class name ang element para maoy stylan

/* 
    var input = document.querySelector('.input');
      input.addEventListener('click', function () {
         input.classList.add('active');
      });
      document.addEventListener('click', function (event) {
         if (event.target !== input)
         input.classList.remove('active');
      });

*/




</script>


<script>
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

        // Example usage
        var userId = 1; // Replace with the actual user ID
        var action = "User clicked a button"; // Replace with the actual action

        logAction(userId, action);
    });
</script>
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


/* AJAX FOR LIVE SEARCH */
$(document).ready(function () {
    $("#live-search").keyup(function () {
        var input = $(this).val();
        console.log('Input:', input); // Add this line for debugging

        if (input != "") {
            $.ajax({
                url: 'livesearch_user.php',
                method: 'POST',
                data: { Linput: input },
                success: function (data) {
                    console.log('Ajax Success:', data); // Add this line for debugging
                    $("#searchresult").html(data);
                    $("#data-table").hide();
                    $("logs_table").hide();
                     $("export-table").hide();
                     document.getElementById("open_logs").disabled = true;
                     document.getElementById("open_exports").disabled = true;
                     document.getElementById("open_lists").disabled = true;
   
                    $("#searchresult").show();
                },
                error: function (xhr, status, error) {
                    console.error('Ajax Error:', error); // Add this line for debugging
                }

            });
        } else {
            $("#searchresult").hide();
            $("#data-table").show();
            $("#logs_table").hide();
            $("#export-table").hide();
        }
    });
});


/*     $("#listSearch").keyup(function () {
        var input = $(this).val();
        console.log('Input:', input); // Add this line for debugging

        if (input != "") {
            $.ajax({
                url: 'livesearch_user.php',
                method: 'POST',
                data: { listinput: input },
                success: function (data) {
                    console.log('Ajax Success:', data); // Add this line for debugging
                    $("#searchresult").html(data);
                    $("#data-table").hide();
                    $("#searchresult").show();
                },
                error: function (xhr, status, error) {
                    console.error('Ajax Error:', error); // Add this line for debugging
                }
            });
        } else {
            $("#searchresult").hide();
            $("#data-table").show();
            $("logs_table").hide();
            $("export-table").hide();
        }
    });
 */




/* 
    $("#logSearch").keyup(function () {
        var input = $(this).val();
        console.log('Input:', input); // Add this line for debugging

        if (input != "") {
            $.ajax({
                url: 'livesearch_user.php',
                method: 'POST',
                data: { loginput: input },
                success: function (data) {
                    console.log('Ajax Success:', data); // Add this line for debugging
                    $("#searchresult").html(data);
                    $("#data-table").hide();
                    $("#searchresult").show();
                },
                error: function (xhr, status, error) {
                    console.error('Ajax Error:', error); // Add this line for debugging
                }
            });
        } else {
            $("#searchresult").hide();
            $("#data-table").show();
            $("logs_table").hide();
            $("export-table").hide();
        }
    }); */







    /* $("#exportSearch").keyup(function () {
        var input = $(this).val();
        console.log('Input:', input); // Add this line for debugging

        if (input != "") {
            $.ajax({
                url: 'livesearch_user.php',
                method: 'POST',
                data: { exportinput: input },
                success: function (data) {
                    console.log('Ajax Success:', data); // Add this line for debugging
                    $("#searchresult").html(data);
                    $("#data-table").hide();
                    $("#searchresult").show();
                },
                error: function (xhr, status, error) {
                    console.error('Ajax Error:', error); // Add this line for debugging
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


//change the id name in the edit btn
/* function listBtn() {
    var inputElement = document.getElementById('live-search');
    var inputElement = document.getElementById('exportSearch');
    var inputElement = document.getElementById('logSearch');
    inputElement.id = 'live-search' + ' listSearch'; // Reset and set the new ID
    inputElement.name += ' listinput';
    inputElement.placeholder = 'Search fabric';
}

function logBtn() {
    var inputElement = document.getElementById('live-search');
    var inputElement = document.getElementById('listSearch');
    var inputElement = document.getElementById('exportSearch');
    inputElement.id = 'live-search' + ' logSearch'; // Reset and set the new ID
    inputElement.name += ' loinput';
    inputElement.placeholder = 'Search logs';
}

function exportBtn() {
    var inputElement = document.getElementById('live-search');
    var inputElement = document.getElementById('listSearch');
    var inputElement = document.getElementById('logSearch');

    inputElement.id = 'live-search' + ' exportSearch'; // Reset and set the new ID
    inputElement.name += ' exportInput';
    inputElement.placeholder = 'Search Exports';
} */

</script>   