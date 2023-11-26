
<?php
    include "includes/header.php";
    include "includes/navbar.php";
    include("includes/config.php");
    
?>
    <section class="dashboard">
        <div class="top">
                
                    <input type="text" class="search-box" id="live-search" name="search" autocomplete="off" placeholder="Search User">

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
                    <div>
                        <form action="includes/add_user.php" method="post"> <!-- DEREE NATA -->
                            <button class="add_fabric" type="submit">Add</button>
                        </form>
                    </div>    


                   
                     
                                     <!-- $_SESSION
                                     mag add og image sa database  -->
                                
                               
                <!-- Ang imo sa buhaton unsaon pag gamit og search bar para maka search og data sa table -->
                <!-- Human ana mag himo ka og ajax para alid an ang table depende sa result sa search bar -->
        </div>

                    <ul class="table_nav" id="table_nav">
                        <li><a href="#" id="open_lists" class="fabric_list links">User's Lists</a></li>

                    </ul>

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
                                    $qry = "SELECT id, CONCAT(firstname,' ', lastname) AS name, email, contact, image_name, date_inserted FROM users ORDER BY date_inserted DESC";
                                    $result = $conn->query($qry);
                                    
                                    // Check if the query was successful
                                    if ($result) {
                                        while ($row = $result->fetch_assoc()) {
                                            
                                            echo "<tr>";
                                            echo "<td>" . $i++ . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['contact'] . "</td>";
                                            echo "<td> <img src='img/profile_image/".$row['image_name']."' class='fabric_image'> </td>";
                                        
                                            echo "<td>" . $row['date_inserted'] . "</td>";
                                            echo "<td><form method='post' action='includes/user-delete.php'>
                                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                                            <input type='submit' class='table_btn btn-safe' name='delete_row' value='Delete'>
                                            </form></td>";
                                            
                                            echo "<td><form method='post' action='includes/edit_user_list.php'>
                                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                    <input type='submit' class='table_btn' value='Update'>
                                                </form> </td>";

                                            
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

   



<?php 
        include "includes/footer.php";
        include "includes/scripts.php";
   ?>

   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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

</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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

