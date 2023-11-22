<?php 
include 'includes/config.php';  
  
$id = $_POST['id']; 
$qry = "SELECT * FROM fabric WHERE id = $id";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .data-list {
            margin-bottom: 15px;
        }

        img {
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        form {
            margin-top: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .back {
            margin-top: 15px;
        }

        .back a {
            color: #333;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="data-list">
    <img src='img/fabric_images/<?php echo $row['image_name']; ?>' alt="<?php echo $row['image_name']; ?>" width='100' height='100'>
</div>

<div class="data-list">
    Type: <?php echo $row['type']; ?>
</div>

<div class="data-list">
    Color: <?php echo $row['color']; ?>
</div>

<div class="data-list">
    Price: <?php echo $row['price']; ?>
</div>

<div class="data-list">
    Current Address: <?php echo $row['current_stock_address']; ?>
</div>

<form action="uexport.php" method="post">
    <label for="addr">Export Address</label>
    <input type="text" name="addr" id="addr" required placeholder="Enter the export address" autofocus>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <button type="submit" name="upload">Add</button>
</form>

<div class="back">
    <a href="ustock.php">Back to the Stock Page</a>
</div>

</body>
</html>

<?php 
  
if (isset($_POST['upload'])) {
    $type = $row['type'];
    $color = $row['color'];
    $price = $row['price'];
    $caddr = $row['current_stock_address']; // Fix variable name
    $eaddr = $_POST['addr']; // Use the correct form field name

    $qry = "INSERT INTO exports (type, color, price, current_address, export_address) 
            VALUES ('$type', '$color', '$price', '$caddr', '$eaddr')";

    $result = mysqli_query($conn, $qry);
    if ($result) {
        $qry = "DELETE FROM fabric WHERE id = $id"; // Fix typo
        $result = mysqli_query($conn, $qry);
        if ($result) {
            header("Location: ustock.php?success= succes");
        }
    }
}

?>
