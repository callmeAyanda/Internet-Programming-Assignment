<?php
    include("settings_connectScript.php");
    //include("HTMLpages/settings.html");


    if (isset($_POST['submit'])){
        $updateusername = $_POST['username'];
        $updateemail = $_POST['email'];
        $updatepassword = $_POST['password'];

//add new user
        $newusername = $_POST['username'];
        $newemail = $_POST['email'];
        $newpassword = $_POST['password'];

//deleting a user
        $deleteuser = $_POST['delete_username'];


/*
    // Update existing user details
    if (!empty($updateusername) && !empty($updateemail) && !empty($updatepassword)) {
        $sql = "UPDATE users SET username = ?, email = ?, password = ? WHERE username = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssss", $updateusername, $updateemail, $updatepassword, $updateusername);

        if ($stmt->execute()) {
            echo "User settings updated successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }


// Insert new user details (if applicable)
    if (!empty($newusername) && !empty($newemail) && !empty($newpassword)) {
        $sql_insert = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt_insert = $connection->prepare($sql_insert);
        $stmt_insert->bind_param("sss", $newusername, $newemail, $newpassword);

        if ($stmt_insert->execute()) {
            echo "New user added successfully.";
        } else {
            echo "Error adding new user: " . $stmt_insert->error;
        }
    }

    // Delete user
    if (!empty($deleteuser)) {
        $sql_delete = "DELETE FROM users WHERE username = ?";
        $stmt_delete = $connection->prepare($sql_delete);
        $stmt_delete->bind_param("s", $deleteuser);

        if ($stmt_delete->execute()) {
            echo "User deleted successfully.";
        } else {
            echo "Error deleting user: " . $stmt_delete->error;
        }
    }


        
*/

    $connection->close();
?>
