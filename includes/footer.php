<?php include "config.php";

    $qry ="SELECT * FROM users";
    $result = mysqli_query($conn, $qry);
    

?>
<footer>
    <p>Created by: FSCS</p>
    <?php
      /*   echo" <img src='img/profile_image/".."'>";
     */
    ?>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
