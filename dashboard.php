
<?php
    include "includes/header.php";
    include "includes/navbar.php";
?>
    <section class="dashboard">
       
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

    

   <?php 
        include "includes/footer.php";
        include "includes/scripts.php";
      
   ?>

    <script src="js/main.js"></script>
</body>
</html>