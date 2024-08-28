<?php
    include("connectScript.php");
    include("HTMLpages/settings.html");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Update existing user details
        if (!empty($_POST['username']) && !empty($_POST['email'])) {
            $updateusername = $_POST['username'];
            $updateemail = $_POST['email'];
            $updatepassword = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

            if ($updatepassword) {
                $sql = "UPDATE users SET username = ?, email = ?, password = ? WHERE username = ?";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param("ssss", $updateusername, $updateemail, $updatepassword, $updateusername);
            } else {
                $sql = "UPDATE users SET username = ?, email = ? WHERE username = ?";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param("sss", $updateusername, $updateemail, $updateusername);
            }

            if ($stmt->execute()) {
                echo "User settings updated successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }

        // Insert new user details (if applicable)
        if (!empty($_POST['new_username']) && !empty($_POST['new_email']) && !empty($_POST['new_password'])) {
            $newusername = $_POST['new_username'];
            $newemail = $_POST['new_email'];
            $newpassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

            $sql_insert = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt_insert = $connection->prepare($sql_insert);
            $stmt_insert->bind_param("sss", $newusername, $newemail, $newpassword);

            if ($stmt_insert->execute()) {
                echo "New user added successfully.";
            } else {
                echo "Error adding new user: " . $stmt_insert->error;
            }
            $stmt_insert->close();
        }

        // Delete user
        if (!empty($_POST['delete_username'])) {
            $deleteuser = $_POST['delete_username'];

            $sql_delete = "DELETE FROM users WHERE username = ?";
            $stmt_delete = $connection->prepare($sql_delete);
            $stmt_delete->bind_param("s", $deleteuser);

            if ($stmt_delete->execute()) {
                echo "User deleted successfully.";
            } else {
                echo "Error deleting user: " . $stmt_delete->error;
            }
            $stmt_delete->close();
        }
        $connection->close();
    }
?>
