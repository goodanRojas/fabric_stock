

<!-- <div class="container-fluid">
    <div class="pagetitle">
        <h1>Logs</h1>
        </div>
    </div>

    <br>
    <hr> -->
    


            <?php include('includes/config.php');
                include ('includes/header.php');
                $export_query = $conn->query("SELECT exports.*, CONCAT(users.firstname, ' ', users.lastname) AS name FROM exports LEFT JOIN users ON exports.id = users.id ORDER BY exports.id DESC");
                ?>


                        

                        <table class="table table-bordered table-stripped" id="export-table">
                                <tr>
                                    <th >Incharge</th>
                                    <th >Type</th>
                                    <th >Color</th>
                                    <th >Price</th>
                                    <th >Current Address</th>
                                    <th >Export Address</th>
                                    <th >Date Exported</th>
                                </tr>
                                <?php
                                $random_colors = array('#d3d3f0', '#e0f8e9', '#ffecdf');
                                $previous_color_index = -1;

                                while ($row = $export_query->fetch_assoc()):
                                    do {
                                        $random_index = array_rand($random_colors);
                                    } while ($random_index === $previous_color_index);

                                    $random_color = $random_colors[$random_index];
                                    $previous_color_index = $random_index;
                                    ?>
                                    <tr class='file-item' style="background-color: <?php echo $random_color; ?>">
                                        <td><i><?php echo $row['name'] ?></td>
                                        <td><i><?php echo $row['type'] ?></td>
                                        <td><i><?php echo $row['color'] ?></td>
                                        <td><i><?php echo $row['price'] ?></td>
                                        <td><i><?php echo $row['current_address'] ?></td>
                                        <td><i><?php echo $row['export_address'] ?></td>
                                        <td><i><span> <?php echo $row['date_created'] ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </table>
                      
                                    
</div>