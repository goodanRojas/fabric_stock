

<!-- <div class="container-fluid">
    <div class="pagetitle">
        <h1>Logs</h1>
        </div>
    </div>

    <br>
    <hr> -->
    


            <?php include('includes/config.php');
                include ('includes/header.php');
               $users_query = $conn->query("SELECT CONCAT(users.firstname, ' ', users.lastname) as name, user_log.date_inserted, user_log.activities FROM user_log LEFT JOIN users ON user_log.user_id = users.id ORDER BY user_log.id DESC");
               ?>


                        

                        <table class="table table-bordered table-stripped" id="logs-table">
                                <tr>
                                    <th width="20%" class="">Status</th>
                                    <th width="30%" class="">Users</th>
                                    <th width="20%" class="">Dates</th>
                                </tr>
                                <?php
                                $random_colors = array('#d3d3f0', '#e0f8e9', '#ffecdf');
                                $previous_color_index = -1;

                                while ($row = $users_query->fetch_assoc()):
                                    do {
                                        $random_index = array_rand($random_colors);
                                    } while ($random_index === $previous_color_index);

                                    $random_color = $random_colors[$random_index];
                                    $previous_color_index = $random_index;
                                    ?>
                                    <tr class='file-item' style="background-color: <?php echo $random_color; ?>">
                                        <td><large><span><i class="fa fa-info-circle "></i><span><b><?php echo ucwords($row['activities']) ?></b></large></td>
                                        <td><i><?php echo $row['name'] ?></td>
                                        <td><i><span> <?php echo date('Y/m/d h:i A',strtotime($row['date_inserted'])) ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </table>
                      
                                    
</div>