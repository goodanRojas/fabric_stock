
<?php
    include "includes/header.php";
    include "includes/unavbar.php";
?>
    <section class="dashboard">
        
        <div class="boxes">
            <h2>Total</h2>
           
            

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
                <span class="text">Exports</span>
                <span class="number">
                    <?php
                        $query = "SELECT COUNT(*) FROM exports";
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