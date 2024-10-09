<?php
    include("connectScript.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Assume you're getting the current username from the session
        session_start();
        $current_username = $_SESSION['username'];

        // Update existing user details
        if (!empty($_POST['username']) && !empty($_POST['email'])) {
            $updateusername = $_POST['username'];
            $updateemail = $_POST['email'];
            $updatepassword = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

            if ($updatepassword) {
                // Update with password
                $sql = "UPDATE users SET username = ?, email = ?, password = ? WHERE username = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $updateusername, $updateemail, $updatepassword, $current_username);
            } else {
                // Update without password
                $sql = "UPDATE users SET username = ?, email = ? WHERE username = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $updateusername, $updateemail, $current_username);
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
            $stmt_insert = $conn->prepare($sql_insert);
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
            $stmt_delete = $conn->prepare($sql_delete);
            $stmt_delete->bind_param("s", $deleteuser);

            if ($stmt_delete->execute()) {
                echo "User deleted successfully.";
            } else {
                echo "Error deleting user: " . $stmt_delete->error;
            }
            $stmt_delete->close();
        }

        $conn->close(); // Ensure you use $conn instead of $connection
    }

    include("HTMLpages/settings.html"); // Moved to after logic
?>
