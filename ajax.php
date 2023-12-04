<?php
include("includes/config.php");

if(isset($_POST['toDelete'])){
    $id = $_POST['toDelete'];
    $sql = "DELETE FROM users WHERE id = $id";
    mysqli_query($conn,$sql);
}


if (isset($_POST["edit"])) {
    $target = "img/profile_image/" . basename($_FILES['Eimage']['name']);

    $firstname = $_POST['Efname'];
    $lastname = $_POST['Elname'];
    $email = $_POST['Eemail'];
    $contact = $_POST['Econtact'];
    $pass = $_POST['EeditPass'];
    $image = $_FILES['Eimage']['name'];
    $id = $_POST['EhiddenID'];


    // Check if any required field is empty
    if (empty($firstname) || empty($lastname) || empty($email) || empty($contact) || empty($image) || empty($pass)) {
        // Handle the case where a required field is empty
        header("Location: ../profile.php?error=Please fill out all fields");
        exit();
    }

    // Update user data
    $sql = "UPDATE users SET image_name = ?, firstname = ?, lastname = ?, email = ?, contact = ?, pwd = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $image, $firstname, $lastname, $email, $contact, $pass, $id);



    if ($stmt->execute()) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);

       
        $log_sql = "INSERT INTO user_log (user_id, activities) VALUES(?, 'Updated a row')";
        $log_stmt = $conn->prepare($log_sql);
        $log_stmt->bind_param("i", $id);
        $log_stmt->execute();
        header("user.php");

        $stmt->close();
        $log_stmt->close();
        $conn->close();

}
}
if (isset($_POST["confirmAdd"])) {
    echo '
    <div class="addContainer" >
    <form action="add_user.php" method="post" enctype="multipart/form-data">

        <label for="user_type">User Type</label>
        <input type="radio" name="user_type" value="1" required>Admin
        <input type="radio" name="user_type" value="2" required>User

    <label for="firstname">Firstname</label>
    <input type="text" id="firstname" name="firstname" required placeholder="Enter Firstname">
    
    <label for="lastname">Lastname</label>
    <input type="text" id="lastname" name="lastname" required placeholder="Enter Lastname">

    <label for="email">Email</label>
    <input type="text" id="email" name="email" required placeholder="Enter Email">

    <label for="contact">Contact</label>
    <input type="text" id="contact" name="contact" required placeholder="Enter Contact">

    <label for="image">Image</label>
    <input type="file" id="image" name="image" required>
   
    <button type="submit" name="upload">Add</button>
   
</form>
<button class="closeAdd btn" onclick="closeAddBtn">Back </button>
    </div>    
';
}
?>
